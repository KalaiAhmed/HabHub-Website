window.onload = () =>{
    const FiltersForm = document.querySelector("#filters");
    const searchInput=document.querySelector("#search");


    searchInput.addEventListener("keyup", ()=>{
        const content=document.querySelector("#content");
        content.innerHTML="";
        const searchParams= new URLSearchParams();
        searchParams.append("search",searchInput.value);
        console.log(searchParams.toString());

        const url =new URL(window.location.href);

        fetch(url.pathname+"?"+searchParams.toString()+"&ajax=1",{
            headers :{
                "X-Requested-with":"XMLHttpRequest"
            }

        }).then(response =>response.json()
        ).then(data=>{
            content.innerHTML=data.content;
        }).catch(e=> alert(e)
        );
    });
    document.querySelectorAll("#filters input").forEach(input=>{
        input.addEventListener("change",()=>{
            const Params = new URLSearchParams();
            const Form = new FormData(FiltersForm);
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
        });
    });
}