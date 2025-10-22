import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect(){        
        const carte = document.querySelectorAll('.card');
        const score = document.querySelectorAll('.score');
        const indicateur = document.querySelectorAll('.indic');

        for (let i = 0; i < carte.length; i++) {
            if(score[i].innerHTML >= 100){             
                carte[i].setAttribute('style', 'background-color: #F51D05 !important')
            }else if(score[i].innerHTML >= 10 && score[i].innerHTML < 100){
                carte[i].setAttribute('style', 'background-color: #4763ff !important')
            }else{
                carte[i].setAttribute('style', 'background-color: #56b36d !important')
            }
        }

        for (let i = 0; i < indicateur.length; i++) {
            if(indicateur[i].innerHTML === 'vert'){
                indicateur[i].setAttribute('style', 'background-color: #92f089 !important')
                indicateur[i].innerHTML = '';
            }else if(indicateur[i].innerHTML === 'bleu'){
                indicateur[i].setAttribute('style', 'background-color: #81c7f1 !important')
                indicateur[i].innerHTML = '';
            }else if(indicateur[i].innerHTML === 'rouge'){
                indicateur[i].setAttribute('style', 'background-color: #F07365 !important')
                indicateur[i].innerHTML = '';
            }else if(indicateur[i].innerHTML === 'aucune'){
                indicateur[i].setAttribute('style', 'background-color: #bebebe !important')
                indicateur[i].innerHTML = '';          
            }
        }
        //style général du filtre signalement
        const filtreS = document.querySelector('.side form');
        const filtreSchilds = filtreS.children;
        
        for (let i = 0; i < filtreSchilds.length; i++) {          
            filtreSchilds[i].setAttribute('style', 'margin-top: .5rem')
            filtreSchilds[i].className ='filtre'+[i]
        }

        const departementList = document.querySelector('#departement');
        
        const contactList = document.querySelector('#contact');
      

        for (let i = 0; i < contactList.length; i++) {
                 console.log(contact)
        }
   
        //Division en 2 de la liste des départements et des contacts
        function divided(list, nb, t){
            list.className = "d-flex flex-row"        
            const partL = document.createElement('div')
            const partR = document.createElement('div')
            partL.className = "partleft"
            partR.className = "partright"
            list.appendChild(partL)
            list.appendChild(partR)            
            let part = []
            for (let i = 0; i < nb; i++) {        
                part[i] = list.children[i]
            }
            for (let j = 0; j < t; j++) {   
                partL.appendChild(part[j])     
            }
            for (let k = t; k < part.length; k++) {  
                partR.appendChild(part[k])        
            }  
        }
        
        divided(departementList, 6, 3);
        divided(contactList, 4, 2);


        const selected = document.querySelectorAll('.selected')
        
        for (let i = 0; i < selected.length; i++) {
            selected[i].addEventListener('change',() =>{           
                if(selected[i].value === 'rouge'){
                    selected[i].setAttribute('style', 'background-color: #F07365')                
                }else if(selected[i].value === 'bleu'){
                    selected[i].setAttribute('style', 'background-color: #4763ff')
                }else if(selected[i].value === 'vert'){
                    selected[i].setAttribute('style', 'background-color: #56b36d')
                }else if(selected[i].value === 'aucune'){
                    selected[i].setAttribute('style', 'background-color: #bebebe')
                }else{
                    selected[i].setAttribute('style', 'background-color: none')
                }            
            })
        }

     

        //bouton reset
        function reset(){
            const filtre0 = document.querySelector('.filtre0 input')
            filtre0.value = "";

            const filtre1 = document.getElementsByName('type')
            for (let i = 0; i < filtre1.length; i++) {
                filtre1[i].checked = false;                
            };

            const filtre2 = document.querySelectorAll('.filtre2 .form-check-input')
            for (let i = 0; i < filtre2.length; i++) {
                filtre2[i].checked= false;                
            };

            const filtre3 = document.getElementById('infect');
            for (let i = 0; i < filtre3.options.length; i++) {
                filtre3.options[i].removeAttribute('selected');                
            };
            filtre3.selectedIndex = '0';

            const filtre4 = document.getElementById('serv');
            for (let i = 0; i < filtre4.options.length; i++) {
                filtre4.options[i].removeAttribute('selected');                
            }
            filtre4.selectedIndex = '0';

            const filtre5 = document.querySelectorAll('.filtre5 .form-check-input')
            for (let i = 0; i < filtre5.length; i++) {
                filtre5[i].checked= false;                
            }

            const filtre6 = document.querySelectorAll('.filtre6 input')
            for (let i = 0; i < filtre6.length; i++) {
                filtre6[i].value = "";                
            }

            const filtre7 = document.querySelectorAll('.filtre7 input')
            for (let i = 0; i < filtre7.length; i++) {
                filtre7[i].value = "";
            }

            function rmv(str){
                const filtre8 = document.getElementById(str);
                for (let i = 0; i < filtre8.options.length; i++) {
                    filtre8.options[i].removeAttribute('selected');                    
                }
                filtre8.selectedIndex = '0';
            }
            rmv('ARS');
            rmv('ES');
            rmv('CPIAS');
            rmv('SPF');

            const filtre9 = document.querySelectorAll('.filtre9 .form-check-input')
            for (let i = 0; i < filtre9.length; i++) {
                filtre9[i].checked= false;                
            };

            const filtre10 = document.querySelectorAll('.filtre10 .form-check-input')
            for (let i = 0; i < filtre10.length; i++) {
                filtre10[i].checked= false;                
            };
        };        

        const rst = document.querySelector('.reset');
        rst.addEventListener('click', ()=>{ reset()});
    }   
}