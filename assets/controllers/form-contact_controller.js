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
        // const parent = document.querySelector('.contact-parent')
        const btn = document.createElement('button')
        btn.setAttribute('class', 'btn btn-secondary mt-1 w-1')
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
