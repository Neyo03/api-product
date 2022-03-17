// import Product from "Product.js"
let from_create = document.getElementById('form_product_create')
let from_edit = document.getElementById('form_product_edit')

if (from_create) {
    from_create.addEventListener('submit', e=>{
        e.preventDefault(); 
        e.stopPropagation()
        let ingredients = [];
        let arrayIngredientsInputs = document.querySelectorAll('.nameInput')
    
        arrayIngredientsInputs.forEach(ingredientInput => {   
            ingredients.push({name:ingredientInput.value})
        });
        
        let product = new Product( e.target[0].value,e.target[1].value,e.target[2].value,e.target[3].value, e.target[4].value, e.target[5].value, e.target[6].value, e.target[7].value, e.target[8].value, e.target[9].value, ingredients)
        product.post()
          
    })
}
if (from_edit) {
    document.getElementById('form_product_edit').addEventListener('submit', e=>{
        e.preventDefault(); 
        e.stopPropagation()
    
        let id = window.location.pathname.substring(14) ;

        let ingredients = [];
        let arrayIngredientsInputs = document.querySelectorAll('.nameInput')
    
        arrayIngredientsInputs.forEach(ingredientInput => {   
            ingredients.push({name:ingredientInput.value})
        });
        
        let product = new Product( e.target[0].value,e.target[1].value,e.target[2].value,e.target[3].value, e.target[4].value, e.target[5].value, e.target[6].value, e.target[7].value, e.target[8].value, e.target[9].value, ingredients, id)
        product.patch()
          
    })
}



