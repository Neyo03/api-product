class Product{
    id = null
    kcal
    kj
    fat
    saturedFat
    carbohydrate
    sugar
    fiber
    protein
    salt
    ean
    ingredients = [];

    constructor(kcal,kj,fat,saturedFat,carbohydrate,sugar,fiber,protein,salt,ean,ingredients,id){
        this.id = id
        this.kcal = kcal
        this.kj = kj
        this.fat = fat
        this.saturedFat =saturedFat
        this.carbohydrate =carbohydrate
        this.sugar =sugar
        this.fiber =fiber
        this.protein =protein
        this.salt =salt
        this.ean =ean
        this.ingredients = ingredients;
    }

    post(){
        
        axios({
            method: 'POST',
            url: '/api/products',
            data: this
        }).then(res => {
            console.log(res);
            alert(res.data.success)
            window.location.reload()
        }).catch(error => {      
            console.log(error);
        })

    }

    patch(){
        
        axios({
            headers: {'content-type': "application/merge-patch+json"} ,
            method: 'PATCH',
            url: '/api/products/'+this.id,
            data: this
        }).then(res => {
            alert(res.data.success)
            window.location.reload()
        }).catch(error => {      
            console.log(error);
        })
        
    }

    delete(){
        
        axios({
            method: 'DELETE',
            url: '/api/products/'+this.id,
            data: this
        }).then(res => {
            console.log(res);
            alert(res.data.success)
            window.location.reload()
        }).catch(error => {      
            console.log(error);
        })
        
    }

    

}