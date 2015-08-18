<h1>Infinite scroll - Bolt extension</h1>

<h2>Usage:</h2>
<ul>
<li>add {{ infiniteScroll() }} after records listing</li>
<li> et listing_records and recordsperpage to config of your content type. Example:
    listing_records: 6
    sort: -datepublish
    recordsperpage: 6
</li>
<li>To override default listing template add infinitescroll_template to config of your content type. Example:
    infinitescroll_template: your-template.html.twig
</li>
</ul>
