<h1>Infinite scroll - Bolt extension</h1>

<h2>Usage:</h2>
<ul>
<li>add {{ infiniteScroll() }} after records listing</li>
<li>set listing_records and recordsperpage to config of your content type. Example:<br>
    listing_records: 6<br>
    sort: -datepublish<br>
    recordsperpage: 6<br>
</li>
<li>To override default listing template add infinitescroll_template to config of your content type. Example:<br>
    infinitescroll_template: your-template.html.twig<br>
</li>
</ul>
