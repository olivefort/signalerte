import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    

    connect() {
        this.index = this.element.childElementCount
        const btn = document.createElement('button');
        btn.setAttribute('class', 'ajout btn btn-secondary mt-4');
        btn.innerText = 'ajouter un agent infectieux';
        btn.setAttribute('type', 'button');
        btn.addEventListener('click', this.addElement);
        const child = this.element.childNodes
        for (let i = 1; i < child.length; i++) {  
                this.addDeleteButton(child[i])
        }
        this.element.append(btn)
    }

    addElement = (e) => {
        e.preventDefault()
        const element = document.createRange().createContextualFragment(
            this.element.dataset['prototype'].replaceAll('__name__', this.index)
        ).firstElementChild
        this.addDeleteButton(element)
        this.index++
        e.currentTarget.insertAdjacentElement('beforebegin',element)
    }

    addDeleteButton = (item) => {
        const btn = document.createElement('button')
        btn.setAttribute('class', 'btn btn-secondary mt-4')
        btn.innerText = this.deleteLabelValue || 'Supprimer'
        btn.setAttribute('type', 'button')
        item.append(btn)
        btn.addEventListener('click', e => {
            e.preventDefault()
            item.remove();
        })
    }
}