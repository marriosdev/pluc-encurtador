function see() {
    let icon = document.getElementById("icon-pass")
    let input = document.getElementById("input-pass")

    if(icon.name == "eye-outline")
    {
        icon.setAttribute("name", "eye-off-outline")
        input.setAttribute("type", "password")           
    }
    else if(icon.name == "eye-off-outline")
    {
        icon.setAttribute("name", "eye-outline")
        input.setAttribute("type", "text")           
    }
}

// Button theme

function theme() {
    let button = document.getElementById("button-theme")
    let body   = document.getElementById("body")
    if (button.name == "moon-outline")
    {
        button.setAttribute("name", "sunny-outline")
        body.style.background ="white"
        button.style.color="black"

    }
    else if(button.name == "sunny-outline")
    {
        button.setAttribute("name", "moon-outline")
        button.style.color="white"
        body.style.background ="black"
    }
}

function open_menu() {
    let button = document.getElementById("button-mobile-menu")
    let menu = document.getElementById("navbar-menu")
    menu.style.display="flex"

    // Se for o menu hamburguer, ele abrir o menu e mudará o icone para close
    if(button.name == "menu-outline")
    {
        menu.style.display="flex"
        button.style.transform="rotate(90deg)"
        button.setAttribute("name", "close-outline")
    }
    //Se estiver com o close, ele irá fechar o menu e mudar o icone para hamburguer
    else if(button.name == "close-outline")
    {
        menu.style.display="none"
        button.style.transform="rotate(0deg)"
        button.setAttribute("name", "menu-outline")
    }

}