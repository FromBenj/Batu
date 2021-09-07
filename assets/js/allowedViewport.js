export function viewportManagement(){
    if (window.innerWidth > 576) {
        console.log('viewport too large')
        location.replace(viewportReplaceUrl)
    }
}


