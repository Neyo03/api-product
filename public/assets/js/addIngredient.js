let divIngredient = []
let collectionIngredient, boutonAjoutIngredient, spanIngredient;

window.onload = () => {

    collectionIngredient = document.querySelector("#ingredients");

    spanIngredient = collectionIngredient.querySelector("span");

    boutonAjoutIngredient = document.createElement("button");
    boutonAjoutIngredient.type = "button";
    boutonAjoutIngredient.className = "ajout-ingredient btn btn-success";

    boutonAjoutIngredient.innerText = "+";

    spanIngredient.append(boutonAjoutIngredient);

    collectionIngredient.dataset.index = collectionIngredient.querySelectorAll("input").length;
  
    divIngredient.push(collectionIngredient.querySelectorAll(".ingredientDelete"));

    for (let j = 0; j < collectionIngredient.dataset.index; j++) {

        let idIngredient = divIngredient[0][j].id.substr(3);
        let btnSupprimeIngredient = document.createElement("button");
        btnSupprimeIngredient.type = "button";
        btnSupprimeIngredient.className = "btn btn-danger ingredientDelete";
        btnSupprimeIngredient.id = "delete-ingredients-" + (j);

        btnSupprimeIngredient.innerText = "-";
        divIngredient[0][j].append(btnSupprimeIngredient);
        btnSupprimeIngredient.addEventListener("click", function () {
            divIngredient[0][j].previousElementSibling.parentElement.remove();
            
        })


    }
    boutonAjoutIngredient.addEventListener("click", function (e) {
        e.stopPropagation()
        addButtonIngredient(collectionIngredient);
    });

}

function addButtonIngredient(collectionIngredient) {
    let prototype = collectionIngredient.dataset.prototype;
    let indexIngredient = collectionIngredient.dataset.index;

    prototype = prototype.replace(/__name__/g, indexIngredient);
    let content = document.createElement("html");
    content.innerHTML = prototype;

    let newForm = content.querySelector("div");
    let boutonSuppr = document.createElement("button");
    boutonSuppr.type = "button";
    boutonSuppr.className = "btn btn-danger ingredientDelete";
    boutonSuppr.id = "delete-ingredients-" + indexIngredient;
    boutonSuppr.innerText = "-";

    newForm.append(boutonSuppr);
    collectionIngredient.dataset.index++;
    let boutonAjout = collectionIngredient.querySelector(".ajout-ingredient");

    spanIngredient.insertBefore(newForm, boutonAjout);
    boutonSuppr.addEventListener("click", function () {
        this.previousElementSibling.parentElement.remove();
    })
}
