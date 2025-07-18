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
        for (let i = 0; i < child.length; i++) {  
                this.addDeleteButton(child[i])
        }
        this.element.childNodes.forEach(this.attrib)
        this.element.append(btn)
        // console.log(this.element)
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
        element.firstChild.setAttribute('class', 'grid agent')
        const ag = document.querySelectorAll('.agent')
        for (let i = 0; i < ag.length; i++) {
            const orga = ag[i].firstChild
            orga.setAttribute('class','orga col4')
        }
        // const agentOrga = document.querySelectorAll('.grid .agent div')
        // for (let i = 0; i < agentOrga.length; i++) {            
        //     agentOrga[i].setAttribute('class', 'orga col4')
        // }
        const agentResi = document.querySelectorAll('.agent fieldset')
        for (let i = 0; i < agentResi.length; i++) {            
            agentResi[i].setAttribute('class', 'resi col12')
        }
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