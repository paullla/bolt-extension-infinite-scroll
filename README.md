USAGE:

- set listing_records and recordsperpage to config of your content type. Example:

    listing_records: 6
    sort: -datepublish
    recordsperpage: 6

- add {{ infiniteScroll() }} after records listing

- To override default listing template add infinitescroll_template to config of your content type. Example:

    infinitescroll_template: your-template.html.twig