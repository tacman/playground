import { Controller } from '@hotwired/stimulus';

import {DataTable} from "simple-datatables"

// hmm, not sure how to do this here.
// import '@simple-datatables/dist/style.css';

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = ['table']
    static values = {
        url: String,
        mimeType: String,
    }

    load(url, perPage, sortField, sortDirection) {

        fetch('demo.json')
            .then(response => response.json())
            .then(data => {
                if (!data.length) {
                    return
                }

                let headings = Object.keys(data[0]);
                console.log(headings);

                let datatable = new DataTable(this.tableTarget, {
                    data: {
                        headings: headings,
                        data: data.map(item => Object.values(item))
                    },
                });

                datatable.on("datatable.perpage", function(e) {
                    console.log(e);
                })

                datatable.on("datatable.update", function(e) {
                    // console.log(e);
                })

                datatable.on("datatable.search", function(e) {
                    console.log(e);
                })

                console.log('adding click listener');
                datatable.wrapper.addEventListener("click", e => {
                    const t = e.target.closest("a")
                    console.warn(t.innerHTML);




                    if (t && (t.nodeName.toLowerCase() === "a")) {
                        const i = this.headings.indexOf(t.parentNode);
                        if (t.hasAttribute("data-page")) {
                            console.log(t);
                            this.page(t.getAttribute("data-page"))
                            e.preventDefault()
                        } else if (
                            // options.sortable &&
                            t.classList.contains("dataTable-sorter") &&
                            t.parentNode.getAttribute("data-sortable") != "false"
                        ) {
                            console.log(i, t.parentNode);

                            this.columns().sort(this.headings.indexOf(t.parentNode))
                            e.preventDefault()
                        }
                    }
                }, false)



            });

    }
    connect() {
        console.log('Starting Datatable');
        this.load(this.urlValue);



    }

    // ...
}
