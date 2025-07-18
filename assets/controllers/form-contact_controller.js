import { Controller } from '@hotwired/stimulus';

export default class extends Controller {

    
    connect() {
        this.index = this.element.childElementCount
        const btn = document.createElement('button');
        btn.setAttribute('class', 'btn btn-secondary mt-4');
        btn.innerText = 'ajouter un contact';
        btn.setAttribute('type', 'button');
        btn.addEventListener('click', this.addElement);
        this.element.childNodes.forEach(this.addDeleteButton)
        this.element.childNodes.forEach(this.attrib)
        const signalContact = document.querySelectorAll('.contact .groupe');
        for (let i = 0; i < signalContact.length; i++) {
            console.log(signalContact[i].firstChild);
            signalContact[i].firstChild.setAttribute('class','grid')
        }
        const signalContactField = document.querySelectorAll('.contact .form-group');
        for (let i = 0; i < signalContactField.length; i++) {
            signalContactField[i].setAttribute('class','contactPart col6')            
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
        element.firstChild.setAttribute('class', 'grid cont')
        const cont = document.querySelectorAll('.cont')
        for (let i = 0; i < cont.length; i++) {
            const contactPart = cont[i].childNodes
            for (let j = 0; j < contactPart.length; j++) {
                contactPart[j].setAttribute('class','contactPart col6')
                
            }
        }
    }

    addDeleteButton = (item) => {
        // const parent = document.querySelector('.contact-parent')
        const btn = document.createElement('button')
        btn.setAttribute('class', 'btn btn-secondary mt-2 w-1')
        btn.innerText = this.deleteLabelValue || 'Supprimer le contact'
        btn.setAttribute('type', 'button')
        item.append(btn)
        // parent.appendChild(btn)
        btn.addEventListener('click', e => {
            e.preventDefault()
            item.remove()
        })
    }
}
