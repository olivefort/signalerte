import { Controller } from '@hotwired/stimulus';

/**
 * 
 * Création du bouton "Ajout d'une souche" dans le formulaire d'ajout d'un signalement
 */

export default class extends Controller {
    connect() {
        this.index = this.element.childElementCount
        const btn = document.createElement('button');
        btn.setAttribute('class', 'btn btn-secondary mt-4');
        btn.innerText = 'ajouter une souche';
        btn.setAttribute('type', 'button');
        btn.addEventListener('click', this.addElement);
        this.element.childNodes.forEach(this.addDeleteButton)
        this.element.childNodes.forEach(this.attrib)
        const signalSouche = document.querySelectorAll('.souche .groupe');
        for (let i = 0; i < signalSouche.length; i++) {
            console.log(signalSouche[i].firstChild);
            signalSouche[i].firstChild.setAttribute('class','grid')
        }
        const signalSoucheField = document.querySelectorAll('.souche .form-group');
        for (let i = 0; i < signalSoucheField.length; i++) {
            signalSoucheField[i].setAttribute('class','souchePart col4')            
        }
        this.element.append(btn)        
    }
    attrib = (e)=>{
        e.setAttribute('class','groupe')
    }

    addElement = (e) => {
        e.preventDefault()
        const element = document.createRange().createContextualFragment(
            this.element.dataset['prototype'].replaceAll('__name__', this.index)
        ).firstElementChild
        this.addDeleteButton(element)
        this.index++
        e.currentTarget.insertAdjacentElement('beforebegin',element)
        element.setAttribute('class', 'groupe')
        element.firstChild.setAttribute('class', 'grid sou')
        const sou = document.querySelectorAll('.sou')
        for (let i = 0; i < sou.length; i++) {
            const souchePart = sou[i].childNodes
            for (let j = 0; j < souchePart.length; j++) {
                souchePart[j].setAttribute('class','souchePart col4')
                
            }
        }
    }

    addDeleteButton = (item) => {
        // const parent = document.querySelector('.souche-parent')
        const btn = document.createElement('button')
        btn.setAttribute('class', 'btn btn-secondary mt-2 w-1')
        btn.innerText = this.deleteLabelValue || 'Supprimer la souche'
        btn.setAttribute('type', 'button')
        item.append(btn)
        // parent.appendChild(btn)
        btn.addEventListener('click', e => {
            e.preventDefault()
            item.remove()
        })
    }
}
