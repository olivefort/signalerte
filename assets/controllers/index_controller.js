import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect(){
        
        const carte = document.querySelectorAll('.card');
        const score = document.querySelectorAll('.score')
        console.log(carte.length)
        for (let i = 0; i < carte.length; i++) {
            console.log(score[i].innerHTML);
            if(score[i].innerHTML >= 100){             
                carte[i].setAttribute('style', 'background-color: #ff3f3f !important')
            }else if(score[i].innerHTML >= 10 && score[i].innerHTML < 100){
                carte[i].setAttribute('style', 'background-color: #4763ff !important')
            }else{
                carte[i].setAttribute('style', 'background-color: #56b36d !important')
            }
        }
    }
    

}