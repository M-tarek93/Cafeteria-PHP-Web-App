let form = document.getElementById("orderForm");
let inputTotal = document.querySelector("input[name='totalprice']");
inputTotal.value = 0;
let indexToStart = 0;
function addToCart(){
    // window.alert(this.dataset.name + " "  + this.dataset.price + " " + this.dataset.id);

    if( form.contains(document.querySelector("input[data-name='" + this.dataset.name + this.dataset.id + "'")) ){
        window.alert("Item already in cart");
    } else {

        item = createHiddenInput();
        item.value = this.dataset.id + ":" + 1;
        item.title = this.dataset.name;
        item.dataset.name= this.dataset.name + this.dataset.id;
                
        let label = document.createElement("label");
        label.dataset.name= this.dataset.name + this.dataset.id;
        label.innerHTML = this.dataset.name + ":";
        
        counter = createNumberInput();
        counter.title = this.dataset.name;
        counter.dataset.name= this.dataset.name + this.dataset.id;
        counter.dataset.price = this.dataset.price;

        counter.addEventListener("change", totalAmountAdded);
        
        // addin the items price to the total amount
        inputTotal.value = ( parseInt(inputTotal.value) +  parseInt(this.dataset.price))  ;
        
        form.insertBefore(label, form[indexToStart]);
        form.insertBefore(item, form[indexToStart]);
        form.insertBefore(counter, form[indexToStart]);
        indexToStart++;
    }
    
    // item.checked = "checked";
    
    
}


function createHiddenInput(){
    let item = document.createElement("input");
    item.type="hidden";
    item.name="order[]";
    return item;
}

function createNumberInput(){
    let counter = document.createElement("input");
    counter.setAttribute("min", 0);
    counter.setAttribute("max", 100);
    counter.setAttribute("step", 1);
    counter.type="number";
    counter.value = 1;
    counter.dataset.lastvalue = 1;
    return counter;
}


function totalAmountAdded(){
    let lastvalue = parseInt(this.dataset.lastvalue);
    let currentvalue = parseInt(this.value);

    if(this.value >= 0){  // removing the input if it reaches 0 
        let parent = this.parentElement;
        inputTotal.value = ( parseInt(inputTotal.value ) - ( parseInt(this.dataset.price) * (lastvalue - currentvalue) ) );
        console.log(this.dataset.name); 
        parent.removeChild(document.querySelector("input[data-name='" + this.dataset.name + "']"));
        parent.removeChild(document.querySelector("input[data-name='" + this.dataset.name + "']"));
        parent.removeChild(document.querySelector("label[data-name='" + this.dataset.name + "']"));
        indexToStart--;
    } else {
        
        
        if( currentvalue > lastvalue ){
            inputTotal.value = ( parseInt(inputTotal.value ) + ( parseInt(this.dataset.price) * (currentvalue - lastvalue) ) );
        } else {
            inputTotal.value = ( parseInt(inputTotal.value ) - ( parseInt(this.dataset.price) * (lastvalue - currentvalue) ) );
        }

        let input = document.querySelector("input[data-name='" + this.dataset.name + "'][type='hidden']");
        let inputId = input.value.split(":")[0];
        input.value = inputId + ":" + this.value;
    }
    this.dataset.lastvalue = this.value;
}


let elements = document.getElementsByClassName("product");

for( element of elements){
    element.addEventListener("click", addToCart);
}