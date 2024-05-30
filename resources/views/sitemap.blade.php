<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @forelse ($resources as $resource)
        @if(!empty($resource->ru_title))
        <url>
            <loc>{{ str_replace('.com/ru//', '.com/ru', config('app.url').'ru/'.$resource->ru_uri) }}</loc>
            <lastmod>{{ $resource->updated_at->tz('GMT')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1</priority>
        </url>
        @endif
    @empty
        
    @endforelse
    @forelse ($resources as $resource)
        <url>
            <loc>{{ str_replace('.com/de//', '.com/de', config('app.url').'de/'.$resource->de_uri) }}</loc>
            <lastmod>{{ $resource->updated_at->tz('GMT')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1</priority>
        </url>
    @empty
        
    @endforelse
</urlset>