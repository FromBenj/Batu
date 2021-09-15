export function choosePrice(){
    let priceValue = document.getElementById("service_price")
    if (priceValue) {
        const price = document.getElementById("price-select")
        const priceContainer = document.getElementById("price-container")
        const input = document.createElement("input")
        input.setAttribute('id', "price-value")
        input.setAttribute('class', 'form-control mt-2')
        input.setAttribute('type', 'number')
        input.setAttribute('step', '0.1')
        input.setAttribute('min', '0.1')
        input.setAttribute('placeholder', 'Your price')
        price.addEventListener('click', () => {
            if (price.value === "open" || price.value === "free") {
                if(priceContainer.contains(input)) {
                    priceContainer.removeChild(input)
                }
                priceValue.value = price.value
            } else {
                priceValue.value = "price"
                priceContainer.appendChild(input)
                changePrice()
            }
        })

        function changePrice(){
            input.addEventListener('keyup', () => {
                if(input.value) {
                    priceValue.value = input.value.toString()
                    console.log(typeof (priceValue.value))
                }
            })
        }
    }
}

