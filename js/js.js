if (document.body.contains(document.getElementById("videoChamada"))) {
    var usercamsrc = "imgs/lmao.jpg";
    var cameraligada = true;
    var micon = false;
    var isonchat = false;
    for (let i=1; i<=4; i++) {
        window["estado"+i] = "baixo"
    }



    document.getElementById("videoChamadaBtn1").onclick = function () {

    }

    document.getElementById("videoChamadaBtn2").onclick = function () {

        //mudar a imagem do canto

        if (usercamsrc !== "imgs/lmao2.png") {
            if (usercamsrc ==="imgs/lmao.jpg") {
                usercamsrc ="imgs/lmao3.png"

            }
            else {
                usercamsrc = "imgs/lmao.jpg"
            }
            document.getElementById("userCam").src = usercamsrc
        }
    }

    document.getElementById("videoChamadaBtn3").onclick = function () {
        //Desligar a imagem do canto
        //mudar o icon
        if (cameraligada) {
            cameraligada = false;
            usercamsrc ="imgs/lmao2.png"
            document.getElementById("userCam").src = usercamsrc
            document.getElementById("videoChamadaBtn3").innerHTML = "<i class='fas fa-video iconsSize textoClaro'></i>"
        }
        else {
            cameraligada = true
            usercamsrc = "imgs/lmao.jpg"
            document.getElementById("userCam").src = usercamsrc
            document.getElementById("videoChamadaBtn3").innerHTML = "<i class='fas fa-video-slash iconsSize textoClaro'></i>"
        }

    }

    document.getElementById("videoChamadaBtn4").onclick = function () {
        //mudar o icon
        if (micon) {
            micon = false
            document.getElementById("videoChamadaBtn4").innerHTML = "<i class='fas fa-microphone iconsSize textoClaro'></i>"

        }
        else {
            micon = true;
            document.getElementById("videoChamadaBtn4").innerHTML = "<i class='fas fa-microphone-slash iconsSize textoClaro'></i>"
        }
    }
}

//---------------------------- chat

function adjust_stuff () {



    document.getElementById("mainchat").style.height = window.innerHeight - parseInt(document.getElementById("inputZone").offsetHeight) - parseInt(document.getElementById("navchat").offsetHeight)  + "px";

    if (window.innerWidth>=992) {
        document.getElementById("chatRow").style.height = window.innerHeight -parseInt(document.getElementById("chattitle").offsetHeight) -parseInt(document.getElementById("inputZone").offsetHeight) -parseInt(document.getElementById("navchat").offsetHeight)   + "px"
        document.getElementById("conversaSection").style.display = "block"
        document.getElementById("chatSection").style.display = "block"
    }
    else {
        document.getElementById("chatRow").style.height = window.innerHeight -parseInt(document.getElementById("chattitle").offsetHeight) -parseInt(document.getElementById("inputZone").offsetHeight)  -parseInt(document.getElementById("navchat").offsetHeight)   + "px"
        if (isonchat) {
            document.getElementById("conversaSection").style.display = "none";
            document.getElementById("chatSection").style.display = "block"
        }
        else {
            document.getElementById("conversaSection").style.display = "block";
            document.getElementById("chatSection").style.display = "none";
        }
    }

    document.getElementById("Conversas").style.height = window.innerHeight -parseInt(document.getElementById("conversatitle").offsetHeight)  -parseInt(document.getElementById("navchat").offsetHeight) + "px"
}

function chatBtn () {
    if (window.innerWidth<992) {
        document.getElementById("conversaSection").style.display = "none";
        document.getElementById("chatSection").style.display = "block"
        isonchat = true;
    }
}

function backBtn () {
    if (window.innerWidth<992) {
        document.getElementById("conversaSection").style.display = "block";
        document.getElementById("chatSection").style.display = "none";
        isonchat = false;
    }
}

if (document.body.contains(document.getElementById("chattitle"))) {
    setInterval(adjust_stuff, 1000)
}

document.getElementById("backtbn").onclick = function () {
    backBtn()
}

document.getElementById("joao").onclick = function () {
    chatBtn()
}





// -------------------------- PAGINA TICKETS

function keepButtonUp () {



    window.onscroll = function (e) {
        if (innerHeight + window.scrollY <= document.getElementById("footer").offsetTop) {
            document.getElementById("botaoNovo").style.top = window.innerHeight - document.getElementById("botaoNovo").offsetHeight - 30 + window.scrollY + "px"
        }
        else {
            document.getElementById("botaoNovo").style.top = window.scrollY - parseInt(document.getElementById("botaoNovo").style.height)  - 30  + "px"
        }





    };
}




if (document.body.contains(document.getElementById("ticketsMain"))) {



    document.getElementById("botaoNovo").style.top = window.innerHeight - document.getElementById("botaoNovo").offsetHeight - 30  + "px"


    setInterval(keepButtonUp, 1000)

    for (let i=1; i<=4; i++) {
        document.getElementById("botaoFora"+i).onclick = function () {

            if (window["estado"+i] === "baixo") {
                window["estado"+i] = "cima"
                document.getElementById("botaoDentro"+i).style.transform = "rotate(00deg)"

            }
            else {
                window["estado"+i] = "baixo"
                document.getElementById("botaoDentro"+i).style.transform = "rotate(180deg)"
            }

        }
    }


}