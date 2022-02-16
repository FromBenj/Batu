function newSlot() {
   for (let i = 0; i < 7; i++) {
       const addButton = document.getElementById("day-" + i).getElementsByClassName("add")[0];
       addButton.addEventListener("click", () => {
           console.log(i)
       })
    }
}
function deleteSlot() {
    console.log("deleted")
}

export {newSlot, deleteSlot}
