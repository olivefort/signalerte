import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        this.index = this.element.childElementCount
        const btn = document.createElement('button');
        btn.setAttribute('class', 'ajout btn btn-secondary mt-4');
        btn.innerText = 'ajouter un agent infectieux';
        btn.setAttribute('type', 'button');
        btn.addEventListener('click', this.addElement);
        // const first = document.querySelector('#signalement_agent_0')
        console.log (this.element.childNodes[0].id)
        const nop = 'agent_0'
        console.log(this.element.childNodes.length)
        // this.element.childNodes.forEach(this.addDeleteButton)
        for (let i = 0; i < this.element.childNodes.length; i++) {
            console.log(this.element.childNodes[i])
            element.childNodes[i].addDeleteButton()
        }
       
        // if(this.element.childNodes[0].id == nop){
        //     remove(butsup)
        // }

        this.element.append(btn)
    }

    addElement = (e) => {
        e.preventDefault()
        const element = document.createRange().createContextualFragment(
            this.element.dataset['prototype'].replaceAll('__name__', this.index)
        ).
        this.addDeleteButton(element)
        this.index++
        e.currentTarget.insertAdjacentElement('beforebegin',element)
    }

    addDeleteButton = (item) => {
        const btn = document.createElement('button');
        btn.setAttribute('class', 'supp btn btn-secondary mt-4');
        btn.innerText = 'supprimer';
        btn.setAttribute('type', 'button');
        item.append(btn)
        btn.addEventListener('click', e => {
            e.preventDefault()
            item.remove()
        })
    }
}