// if (window.location.pathname = '/signalement/') {
//     console.log('bonne page')
// }else{
//     console.log('mauvaise page')
// }

// const local = window.location.pathname;
// if(local == '/signalement'){
//     console.log('bonne page')
// }else{
//     console.log('mauvaise page')

// }


// document.addEventListener("DOMContentLoaded", (e) => {
    
//     // const number = document.querySelectorAll('.show');
//     // console.log(number)
//         let score = 0
//         console.log('DOM fully loaded');
//         const etiologie = document.querySelectorAll('.etio')[0].innerText;
//         console.log(etiologie);
//         if(etiologie == 'VIH Hépatite'){
//             score = score + 100
//             console.log(score)
//         }else if(etiologie == 'C. Diffile' || etiologie == 'BHRe'){
//             score = score + 5
//             console.log(score)
//         }else if(etiologie == 'IRA'|| etiologie == 'GEA' || etiologie == 'Gale' || etiologie == 'SAU' || etiologie == 'Environnement'){
//             score = score + 1
//             console.log(score)
//         }else{
//             score = score + 10
//             console.log(score)
//         }

//         const epidemie = document.querySelectorAll('.epi')[0].innerText;
//         console.log(epidemie)
//         if(epidemie == 'Épidémie'){
//             score = score + 2
//             console.log(score)
//         }else{
//             score = score + 1
//             console.log(score)
//         }

//         const gravite = document.querySelectorAll('.grav')[0].innerText;
//         console.log(gravite);
//         if(gravite == 'Gravité avérée'){
//             score = score + 2
//             console.log(score)
//         }else{
//             score = score + 1
//             console.log(score)
//         }

//         const population = document.querySelectorAll('.popu')[0].innerText
//         console.log(population)
//         if(population == 'Population non à risque ou non applicable'){
//             score = score + 1
//             console.log(score)
//         }else{
//             score = score + 2
//             console.log(score)
//         }

//         const recommandation = document.querySelectorAll('.reco')[0].innerText
//         console.log(recommandation)
//         if(recommandation == 'Oui'){
//             score = score + 1
//             console.log(score)
//         }else{
//             score = score + 2
//             console.log(score)
//         }

//         const mesure  = document.querySelectorAll('.mesur')[0].innerText
//         console.log(mesure)
//         if( mesure == 'Oui'){
//             score = score + 1
//             console.log(score)
//         }else{
//             score = score + 2
//             console.log(score)
//         }

//         const capacite = document.querySelectorAll('.capa')[0].innerText
//         console.log(capacite)
//         if(capacite == 'OK'){
//             score = score + 1
//             console.log(score)
//         }else{
//             score = score + 2
//             console.log(score)
//         }

//         const impact = document.querySelectorAll('.impac')[0].innerText
//         console.log(impact)
//         if(impact == 'Non'){
//             score = score + 1
//             console.log(score)
//         }else{
//             score = score + 100
//             console.log(score)
//         }

//         const total = document.querySelectorAll('.score')[0]
//         console.log(total)
//         total.innerText = score;
    

    //     if(score >= 10 && score < 99){
    //     total[i].style.background = 'blue'        
    // }else if(score >= 99){
    //     total[i].style.background = 'red'
    // }else{
    //     total[i].style.background = 'green'
    // }
// })

// document.addEventListener("DOMContentLoaded", (e) => {
    // let score = 0
    // const etiol = document.querySelector('#signalement_etiologie')
    // const etiologie = etiol.options[etiol.selectedIndex].text
    // console.log(etiologie)
    // if(etiologie == 'VIH Hépatite'){
    //     score = score + 100
    //     console.log(score)
    // }else if(etiologie == 'C. Diffile' || etiologie == 'BHRe'){
    //     score = score + 5
    //     console.log(score)
    // }else if(etiologie == 'IRA'|| etiologie == 'GEA' || etiologie == 'Gale' || etiologie == 'SAU' || etiologie == 'Environnement'){
    //     score = score + 1
    //     console.log(score)
    // }else{
    //     score = score + 10
    //     console.log(score)
    // }


    // const valide = document.querySelector('.valider');
    // console.log(valide)
    // if(valide){
    //     valide.addEventListener('click',()=>{
    //         console.log('valide!!')
    //     })
    // }
    // const scores = document.querySelector('.score');
    // console.log(scores)
    // if(scores){
    //     scores.innerText = score
    // }
    // const scoring = document.querySelectorAll('.score-index');
    // console.log(scoring.length)
    // for (let i = 0; i < scoring.length; i++) {
        
    //     console.log(scoring[i])
    // }
    // const scoretest = document.querySelector('.scoretest input');
    // console.log(scoretest.value)
    // scoretest.innerText = score

    // const butscore = document.querySelector('.button-score');
    // console.log(butscore)
    // butscore.addEventListener('click', ()=>{
    //     console.log(score)
    // })
// document.addEventListener("DOMContentLoaded", () => {
//     const reset = document.querySelector('.modif')
//     const valider = document.querySelector('.valider')
//     const scores = document.querySelector('#signalement_score')
//     if(reset){
//         reset.addEventListener('click', ()=>{
//             console.log('reset')
//         })
//     }
    
//     if(valider){
//         let score = 0
//         const etiol = document.querySelector('#signalement_etiologie')
//         etiologie = etiol.options[etiol.selectedIndex].text
//         console.log(etiologie)
//         console.log(score)
//         valider.addEventListener('click', ()=>{
//             console.log('click valide')
//             if(etiologie == 'VIH / Hépatite'){
//                 score = score + 100;
//                 console.log('vih')
//             }else{
//                 score = score + 10
//                 console.log(score)
//                 console.log('autre')
//             }
//             scores.value = score
//             console.log(score)
//         })
//     }        
// })

// document.addEventListener("DOMContentLoaded", (e) => {
//     let score = 0;
  
//     const scores = document.querySelector('#signalement_score');
//     const etiol = document.querySelector('#signalement_etiologie');
  
//     etiol.addEventListener('change', (e) => {
//     //   etiologie = e.target.value;
//       etiologie = etiol.options[etiol.selectedIndex].text;
//       console.log(etiologie)
//       scores.value = score + (etiologie == 'VIH / Hépatite' ?  100 : 10);
//     });
// });

document.addEventListener("DOMContentLoaded", (e) => {
    let score = 0;

    const scores = document.querySelector('#signalement_score');
    const etiol = document.getElementById('signalement_etiologie');
 
//    etiol.addEventListener('change', (e) => {
//      scores.value = score + (e.target.value === 'VIH / Hépatite' ?  100 : 10);
//        console.log(scores.value)
//    });

   etiol.addEventListener('change', (e) => scores.value = e.target.value === 'VIH / Hépatite' ?  100 : 10);
});
