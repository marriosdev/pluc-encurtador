<?php

namespace App\Http\Controllers;
use App\Models\Link;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

//Chamando a classe Request para  pegar os dados enviados pelo usuario
use Illuminate\Http\Request;

class Links extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*
    /
    */
    public function index()
    {
        $user  = auth()->user();
        $links = new Link();
        $links = $links::where("clicks", ">",  0)->orderByDesc("clicks")->take(10)->get();
        $cont  = 0;
        return view("welcome" , ["user"=>$user, "links"=>$links, "cont"=>$cont]);
    }

    /*
    /
    */
    public function store(Request $request)
    {
        if(!$request){
            return redirect("/");

        }
        if(!preg_match("/http/", $request->link)) {
           $request->link = "https://".$request->link;
        }
        // var_dump(gethostbyaddr($request->link));
        // if(!filter_var($request->link, FILTER_VALIDATE_URL)){
        //     
        // }
        try {
            get_headers($request->link);

        } catch (\Throwable $th) {
            return redirect("/")->with("erro_link", "Link inválido.");
        }

        $link = new Link(); 
        $string_generat ="";
        $name = $request->link;

        //Se não existir link personalizado, o sistema gera um pro usuário
        if(!$request->perso_link){  

            //Isso aqui é um loop que verifica se a URL gerada já existe no banco.
            //Caso exista, o sistema gera mais uma vez.
            do{
                for($i=0;$i<7;$i++) {
                    $strings         = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                    $string_random   = random_int(0, 51);
        
                    // Adicionando uma letra aleatória em $strings, que está no índice equivalente ao $string_random
                    $string_generat .= $strings[$string_random]; 
                }
                $search_link = Link::where("link_encurt", "=", $string_generat)->first();
            }while($search_link);

            $link->link_encurt = $string_generat; //Formatando o link completo

        }else{
            $search_link = Link::where("link_encurt", "=", $request->perso_link)->first();
            
            if($search_link){
                return redirect("/")->with("erro_perso", "Link personalizado já existente, por gentileza, escolha outro.");
            
            }else{
                $link->link_encurt = $request->perso_link;
            }
            
        }

        $link->status = 1;
        $link->clicks = 0;
        $link->link_orig  = $request->link;

        if(!auth()->user()) {
            $link->user_id = 1;

        }else {
            $user           = auth()->user();
            $link->user_id  = $user->id;
        }

        $link->save();//Salvando os dados
        return view("link", ["link_orig"=>$link->link_orig, "link_encurt"=>$_SERVER['HTTP_HOST']."/".$link->link_encurt, "user"=> auth()->user()]);
    }    

    /*
    /
    */
    public function redirectLink($string)
    {
        $link = new Link();
        
        //Procurando o link no banco, caso não exista, ele retorna null.
        $link_url = $link->where(
            'link_encurt', '=', $string)
                ->get()
                ->first();
        
        //Se o valor for nulo, ele é redirecionado para a rota "/".
        if($link_url['status'] == 0){
            return view("error");
        }

        if(!$link_url){
            return redirect("/");
        }

        $link->where(
            'link_encurt', '=', $string)
                ->get()
                ->first()
                ->update(["clicks"=>$link_url['clicks']+1]);
        
        //Verifica se tem http no link, se não tiver, o script adiciona.
        if(!preg_match("/http/", $link_url['link_orig'])) {
            return redirect("http://".$link_url["link_orig"]);

        }else{
            return redirect($link_url["link_orig"]);
        }
    }

    /*
    /
    */
    public function dashboard()
    {
        // Pegando o usuário logado na sessão
        $link          = new Link();
        $user          = new User();
        $count_clicks  = 0;
        $user_session  = auth()->user();
        $links         = $link->where("user_id", "=", $user_session->id)->get();

        $today_link    = $link->whereBetween('created_at', [date("Y-m-d".' 00:00:00'), date("Y-m-d").' 23:59:59'])
                                            ->where("user_id", "=", $user_session->id)
                                            ->get();

        $today_link    = $today_link->count();
        foreach($links as $clicks){
            $count_clicks += $clicks->clicks;
        }
        
        $count        = count($links);
        return view("dashboard", ["user"=>$user_session, "links"=>$links, "count"=>$count, "clicks"=>$count_clicks, "today"=>$today_link]);
    }

    /*
    /
    */
    public function delete($id)
    {
        Link::where("id", "=", $id)->delete();
        return redirect("/dashboard")->with("msg", "Deletado com sucesso!");
    }

    /*
    /
    */
    public function info($id)
    {
        $link = Link::findOrFail($id);
        $user = auth()->user();
        if(!$link){
            return redirect("/");
        }else{
            return view("info", ["info"=>$link, "user"=>$user]);
        }
    }

    /*
    /
    */
    public function linkOff($id)
    {
        $link = Link::findOrFail($id);

        if($link->status == 0) {
            $link->update(["status"=>1]);

        }else{
            $link->update(["status"=>0]);
        }
        return redirect("/info/{$id}");
    }
}
