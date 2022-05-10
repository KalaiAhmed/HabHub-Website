window.onload = () =>{
    const FiltersForm = document.querySelector("#filters");
    const searchInput=document.querySelector("#search");
    const content=document.querySelector("#content");


    searchInput.addEventListener("keyup", ()=>{

        content.innerHTML="";
        sendSearchFilterRequest();

    });
    document.querySelectorAll("#filters input").forEach(input=> {
        input.addEventListener("change", () => {
            sendSearchFilterRequest();
        });
    });

    function sendSearchFilterRequest(){
        const Params = new URLSearchParams();
        const Form = new FormData(FiltersForm);
        Params.append("search",searchInput.value);
        Form.forEach((value,key)=>{
            Params.append(key, value);
        });
        const url = new URL(window.location.href);
        fetch(url.pathname+"?"+Params.toString()+"&ajax=1",{
            headers:{
                "X-Requested-With": "XMLHttpRequest"
            }

        }).then(response =>
            response.json()
        ).then(data=>{
            const content = document.querySelector("#content");
            content.innerHTML=data.content;


        }).catch(e=>alert(e));
    }
}