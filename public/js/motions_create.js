

let parameters = []
let tipoPregunta = ""

function removeElement(event, position) {
    event.target.parentElement.remove()
    delete parameters[position]
}




const addJsonElement = json => {
    parameters.push(json)
    return parameters.length - 1
}

(function load() {
    //CARGA DE TODOS LOS ELEMENTOS DEL FORMULARIO
    const $form = document.getElementById("frmProductos")
    const $FormFinal = document.getElementById("FormFinal")
    const $divElements = document.getElementById("divElements")
    const $btnSave = document.getElementById("btnSave")
    const $btnAdd = document.getElementById("btnAdd")


    //BOTON DE ELIMINACION DE REGISTROS TEMPORALES
    const templateElement = (data, position) => {
        return (`
            <button class="delete" onclick="removeElement(event, ${position})"></button>
            <strong class='badge badge-light'>Repuesto</strong> <br>${data}
        `)
    }

    //AL ENVIAR EL BOTON FINAL, SE SUBE TODA LA INFORMACION

    $btnAdd.addEventListener("click", (event) => {

            if($form.cant.value != ""){


            let index = addJsonElement({
                cant: $form.cant.value,
                supply_id: $form.supply.value
            })

            const $div = document.createElement("div")
            $div.classList.add("notification", "is-link", "is-light", "py-2", "my-1")


            var combo = document.getElementById("supply");
            var selected = combo.options[combo.selectedIndex].text;

            let str = selected;
            let arr = selected.split('- S/.');

            let cantidad = $form.cant.value;

            $div.innerHTML = templateElement(
                `<strong> Cantidad:</strong> ${$form.cant.value} <br><strong>Nombre:</strong>
                ${selected}<br><strong>Sub Total:</strong> S/. ${arr[1]* cantidad}`, index)

            $divElements.append($div)
            //$form.reset()
        } else {
            alert("Cantidad no puede ser 0")

        }

    })

    $btnSave.addEventListener("click", (event) => {

        const $form = document.getElementById("FormFinal");
            let title = document.getElementById("title").value;
            let detail = document.getElementById("detail").value;
            let car = document.getElementById("car").value;


            $form.title_h.value = title;
            $form.detail_h.value = detail;
            $form.id_car_h.value = car;



            parameters = parameters.filter(el => el != null)
            const $jsonDiv = document.getElementById("jsonDiv")
            document.getElementById("hiden_json").value = `${JSON.stringify(parameters)}`

            $divElements.innerHTML = ""
            parameters = []

          $FormFinal.submit()

    })

})()

