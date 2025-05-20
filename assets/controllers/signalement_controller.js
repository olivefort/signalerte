import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['type','etiologie', 'epidemie', 'gravite', 'population' , 'score'];

    updateLengthNum(){        
        const type = this.typeTarget.value;
        console.log(type)
        const num = document.querySelector("#signalement_numero")
        console.log(num)
        if(type === 'ESIN'){
            num.setAttribute('style', "display:block" )
            num.value = ""            
            num.setAttribute("maxlength", 5)
            console.log(num)
        }else if(type === 'Portail'){
            num.setAttribute('style', "display:block" )
            num.value = ""            
            num.setAttribute("maxlength", 6)
            console.log(num)
        }else{
            num.setAttribute('style', "display:none" )
        }
    }

    updateScore() {
        let score = 0; 
        const etio = this.etiologieTarget.value;
        if(etio === 'VIH / Hépatite'){
            score = score + 100
            console.log(score);
        }else if(etio == 'C. Difficile' || etio == 'BHRe'){
            score = score + 5
            console.log(score);
        }else if(etio == 'IRA'|| etio == 'GEA' || etio == 'Gale' || etio == 'SAU' || etio == 'Environnement'){
            score = score + 1
            console.log(score);
        }else{
            score = score + 10
            console.log(score);
        }

        console.log(etio)
        // this.scoreTarget.value = value === 'VIH / Hépatite' ? 100 : 10;        
        // score = parseInt(this.scoreTarget.value)
        console.log(score);

        const epi = this.epidemieTarget.value;
        epi === "Épidémie" ? score = score + 2 : score = score + 1;
        console.log(epi);

        console.log(score);

        const gravite = this.graviteTarget.value;
        gravite === "Gravité avérée" ? score = score + 2 : score = score + 1;
        console.log(gravite);                

        const population = this.populationTarget.value;
        population === "Population non à risque ou non applicable" ? score = score + 1 : score = score + 2;
        console.log(population);

        console.log(score);
        console.log(this.scoreTarget.value)

        this.scoreTarget.value = score
    }
}