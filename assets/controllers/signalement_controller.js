import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['cas','type','etiologie', 'epidemie', 'gravite', 'population','reco','mesure','capacite','impact','score'];

    updateCas(){
        const nombre = this.casTarget.value;         
        if(nombre == 1){
            this.epidemieTarget.value = "Cas isolé"
        }else{
            this.epidemieTarget.value = "Épidémie"
        }        
    }

    updateLengthNum(){        
        const type = this.typeTarget.value;       
        const num = document.querySelector("#signalement_numero")
        if(type === 'ESIN'){
            num.setAttribute('style', "display:block" )
            num.value = ""            
            num.setAttribute("maxlength", 5)            
        }else if(type === 'Portail'){
            num.setAttribute('style', "display:block" )
            num.value = ""            
            num.setAttribute("maxlength", 6)
        }else{
            num.setAttribute('style', "display:none" )
        }
    }

    updateScore() {
        let score = 0; 
        const etio = this.etiologieTarget.value;
        if(etio === 'VIH / Hépatite'){
            score = score + 100            
        }else if(etio == 'C. Difficile' || etio == 'BHRe'){
            score = score + 5           
        }else if(etio == 'IRA'|| etio == 'GEA' || etio == 'Gale' || etio == 'SAU' || etio == 'Environnement'){
            score = score + 1           
        }else{
            score = score + 10            
        }

        const cas = this.casTarget.value;
        cas > 1 ? score = score + 2 : score = score + 1;        

        const gravite = this.graviteTarget.value;
        gravite === "Gravité avérée" ? score = score + 2 : score = score + 1;                   

        const population = this.populationTarget.value;
        population === "Population non à risque ou non applicable" ? score = score + 1 : score = score + 2;

        const reco = this.recoTarget.value;
        reco === "Oui" ? score = score + 1 : score = score + 2;

        const mesure = this.mesureTarget.value;
        mesure === "Oui" ? score = score + 1 : score = score + 2;

        const capacite = this.capaciteTarget.value;
        capacite ===  "OK" ? score = score + 1 : score = score + 2;
        
        const impact = this.impactTarget.value;
        impact ===  "Non" ? score = score + 1 : score = score + 100;
      
        this.scoreTarget.value = score
    }
}