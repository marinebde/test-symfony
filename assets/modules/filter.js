/**
 * @property {HTMLElement} content
 * @property {HTMLFormElement} form
 */


 export default class Filter {


    /**
     * @param {HTMLElement|null} element 
     */
    
        constructor (element) {
            if (element === null) {
                return
            }
            this.form= element.querySelector('.js-filter-form')
            this.content= element.querySelector('.js-filter-content')
            this.bindEvents()
        }
    
        /**
         * Ajoute les comportements aux différents éléments
         */
        bindEvents() {
            this.form.addEventListener('change', this.loadForm.bind(this))
        }
    
        async loadForm () {
    
            const data = new FormData(this.form)
            const url = new URL(this.form.getAttribute('action') || window.location.href)
            const params = new URLSearchParams()
            
            data.forEach((value, key) => {
                params.append(key, value)
            } )
            return this.loadUrl(url.pathname + '?' + params.toString())
        }
    
        async loadUrl (url) {
            const ajaxUrl = url += '&ajax=1'
            const response = await fetch(ajaxUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' 
                }
            })
            if (response.status >= 200 && response.status < 300) {
                const data = await response.json()
                this.content.innerHTML = data.content
            } else {
                console.error(response)
            }
        }
 }