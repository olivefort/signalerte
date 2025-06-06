import { Controller } from '@hotwired/stimulus';



export default class extends Controller {
    static targets = ['agent','cas','type','etiologie', 'epidemie', 'gravite', 'population','reco','mesure','capacite','impact','score','ARS','ES','CPIAS','SPF'];

    updateCas(){
        const nombre = this.casTarget.value;
        if(nombre <= 0 ){
            this.nombre = 1
        }  
        else if(nombre == 1){
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

  

    agentNew(){  
        const agentdiv = document.querySelectorAll('.agents > div');
        for (let i = 0; i < agentdiv.length; i++) {     
            agentdiv[i].className = "agent"
            agentdiv[i].setAttribute('id','agent_'+i)           
        }

        const agentPart = document.querySelectorAll(".agent");        
        for (let i = 0; i < agentPart.length; i++) {
            agentPart[i].childNodes[0].className = "signalagent my-2 p-3 border border-2 rounded border-black"
            // agentPart[i].className = "part"
        }

        const signalagent = document.querySelectorAll(".signalagent")        
        for (let i = 0; i < signalagent.length; i++) {
            signalagent[i].firstChild.className = "organisme col-4"
            signalagent[i].firstChild.style.display = "flex"
            signalagent[i].firstChild.style.flexDirection = "column"
            signalagent[i].lastChild.className = "resistances"
            signalagent[i].lastChild.style.flexDirection = "column"
            signalagent[i].lastChild.style.display = "flex"
            // if(signalagent[i].id != "signalement_agent_0"){
            //     const del = document.createElement('button')
            //     del.setAttribute('class', 'btn btn-secondary mt-4');
            //     del.innerText = 'supp';
            //     del.setAttribute('type', 'button');
            //     del.addEventListener('click', () => {
            //         signalagent[i].remove()                                
            //     });
            //     signalagent[i].appendChild(del) 
            // }
        }

        const resistance = document.querySelectorAll('.resistance')        
        for (let i = 0; i < resistance.length; i++) {
            resistance[i].style.display = "grid"
            if(window.innerWidth > 1400 ){
                resistance[i].style.gridTemplateColumns = "repeat(12, 1fr)"  
            }else{
                resistance[i].style.gridTemplateColumns = "repeat(6, 1fr)"  
            }
            resistance[i].style.gridTemplateRows = "minmax(25px)"      
            resistance[i].style.rowGap = ".5rem"         
            // const input = resistance[i].querySelectorAll('input')         
            // const label = resistance[i].querySelectorAll('label')         
            resistance[i].lastChild.style.gridColumn = "span 3"
            // console.log(resistance[i].childNodes)
            // const cpl = document.createElement('div')
            // for (let j = 0; j < resistance[i].childElementCount/2; j++) {                
            //     input[j].className = "input"
            //     label[j].className = "label"
            //     const cpl = document.createElement('div')
            //     cpl.appendChild(input[j])
            //     cpl.appendChild(label[j])
            //     resistance[i].appendChild(cpl)                             
            // }               
        }

        // resistance.forEach((res)=> {
        //     res.style.display = "grid"
        //     res.style.gridTemplateColumns = "repeat(12, 1fr)"
        //     res.lastChild.style.gridColumn = "span 6"
        //     const input = res.querySelectorAll('input')         
        //     const label = res.querySelectorAll('label')  
        //     for (let j = 0; j < res.childElementCount/2; j++) {                
        //         input[j].className = "input"
        //         label[j].className = "label"
        //         const cpl = document.createElement('div')
        //         cpl.appendChild(input[j])
        //         cpl.appendChild(label[j])
        //         res.appendChild(cpl)
        //     }
        // })


        
        // for (let i = 0; i < resistance.childElementCount/2; i++) {
            
            
        // }

        // allAgent.firstChild.className = "organisme col-4"
        // allAgent.firstChild.style.display = "flex"
        // allAgent.firstChild.style.flexDirection = "column"
        // allAgent.lastChild.className = "resistances"        
        
        // const input = document.querySelectorAll('.resistance input');
        // const label = document.querySelectorAll('.resistance label');
        // const listRez = document.querySelector('.resistance');
        // listRez.style.display = "grid";
        // listRez.style.gridTemplateColumns = "repeat(12, 1fr)" 
        
        
        // for (let i = 0; i < input.length; i++) {           
        //     input[i].className = 'input_res';         
        //     input[i].style.marginRight = ".5rem";         
        //     label[i].className = 'lab_res';        
        //     const couple = document.createElement('div');                            
        //     listRez.appendChild(couple);
        //     couple.className = "couple";
        //     couple.style.gridColumn = "span 3"
        //     // couple.style.border = "1px solid black"
        //     couple.appendChild(input[i])
        //     couple.appendChild(label[i])
        // }
    
        // const last = listRez.lastChild
        // last.style.gridColumn = "span 6"        
    }

    serviceNew(){
        const input = document.querySelectorAll('.service input');
        const label = document.querySelectorAll('.service label');
        const listServ = document.querySelector('.service');
        listServ.style.display = "grid";
        listServ.style.gridTemplateColumns = "repeat(12, 1fr)" 
        
        
        for (let i = 0; i < input.length; i++) {           
            input[i].className = 'input_res';         
            input[i].style.marginRight = ".5rem";         
            label[i].className = 'lab_res';        
            const couple = document.createElement('div');                            
            listServ.appendChild(couple);
            couple.className = "couple";
            couple.style.gridColumn = "span 4"
            couple.appendChild(input[i])
            couple.appendChild(label[i])
        }
    }

    soucheNew(){
        const part = document.querySelectorAll('.souche div div div')
                
        for (let i = 0; i < part.length; i++) {
            part[i].className = "col-4"
            part[i].parentNode.className = "parent"
        }
        const parent = document.querySelectorAll('.parent')
        for (let i = 0; i < parent.length; i++) {
            parent[i].style.display = "flex"
            parent[i].style.flexDirection = "row"
            parent[i].style.gap = "1.5rem"            
        }
        
    }  

    contactNew(){       
        const part = document.querySelectorAll('.contact div div div');
        for (let i = 0; i < part.length; i++) {
            part[i].className = "col-6"
            part[i].parentNode.className = "parent"
        }
        const parent = document.querySelectorAll('.parent')
        for (let i = 0; i < parent.length; i++) {
            parent[i].style.display = "flex"
            parent[i].style.flexDirection = "row"
            parent[i].style.gap = "1.5rem"            
        }
    }

    colorNote(){
        const test = document.querySelectorAll('.note .form-select');
        const eta = document.querySelectorAll('.eta');
        const cal = document.querySelectorAll('.eta .note')
        // console.log(test.length)
        for (let i = 0; i < test.length; i++) {            
            if (test[i].selectedIndex == 1) {           
                eta[i].style.backgroundColor = "#92f089"
            }else if (test[i].selectedIndex == 2) {
                eta[i].style.backgroundColor = "#81c7f1"
            }else if (test[i].selectedIndex == 3) {
                eta[i].style.backgroundColor = "#e17f87"
            }else{
                eta[i].style.backgroundColor = "#bebebe"
            }
        }
        this.ARSTarget.style.backgroundColor = ""
        this.ESTarget.style.backgroundColor = ""
        this.CPIASTarget.style.backgroundColor = ""
        this.SPFTarget.style.backgroundColor = ""
        
        // const ars = document.querySelector('.ars')
        // if(select == 1){
        //     ars.style.backgroundColor = "green"
        // }else if(select == 2){
        //     ars.style.backgroundColor = "blue"
        // }else if(select == 3){
        //     ars.style.backgroundColor = "red"
        // }else{
        //     ars.style.backgroundColor = "grey"
        // }
    }

    connect(){
        this.agentNew()
        this.serviceNew()
        this.soucheNew()
        this.contactNew()
        this.colorNote()
     
        const scoreEtablissement = document.querySelector('.score')
        // console.log(scoreEtablissement)
        scoreEtablissement.style.display = "grid"
        scoreEtablissement.style.gridTemplateColumns = "repeat(12, 1fr)"
        scoreEtablissement.style.columnGap = "1rem"
        scoreEtablissement.style.rowGap = "1rem"
        const eta = document.querySelectorAll('.eta')
        const title = document.querySelectorAll('.eta h3')
        for (let i = 0; i < eta.length; i++) {
            title[i].style.gridColumn = "span 12"
            eta[i].style.gridColumn = "span 3"        
            eta[i].style.display = "grid"   
            eta[i].style.columnGap = "1rem"
            eta[i].style.marginTop = "1rem"
            eta[i].style.gridTemplateColumns = "repeat(12, 1fr)"
            const note = document.querySelectorAll('.note')
            for (let j = 0; j < note.length; j++) {
                note[j].style.gridColumn = "span 6"                
            }
        }
    }
    
       
        
    }
    
    
 


