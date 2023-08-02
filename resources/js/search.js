import {autocomplete, getAlgoliaResults} from '@algolia/autocomplete-js';
import { createLocalStorageRecentSearchesPlugin } from '@algolia/autocomplete-plugin-recent-searches';

import algoliasearch from 'algoliasearch';

// import '@algolia/autocomplete-theme-classic';

const searchClient = algoliasearch(
    '2WZKZJIBUG',
    '47aff4d104fc8d17682f8a4358a2bfbf'
);

const recentSearchesPlugin = createLocalStorageRecentSearchesPlugin({
  key: 'RECENT_SEARCH',
  limit: 5,
});

const autoComplete = autocomplete({
    container: '#search-neuly',
    placeholder: 'Search Neuly',
    debug: true,
    getSources({query}) {
        return [
            {
                sourceId: 'everything',
                getItems() {
                    return getAlgoliaResults({
                        searchClient,
                        queries: [
                            {
                                indexName: 'everything',
                                query,
                                params: {
                                    hitsPerPage: 50,
                                    attributesToSnippet: ['name:10', 'description: 15'],
                                    snippetEllipsisText: '...',
                                },
                            },
                        ],
                    });
                },
                plugins: [recentSearchesPlugin],
                onSelect({ item }) {
                  recentSearchesPlugin.data.addItem({
                    id: item.objectID,
                    label: item.name,
                    image: item.image,
                    url: item.url,
                  });
                },
                getItemUrl({ item }) {
                    return item.url;
                },
                templates: {
                    item({item, components, html}) {
                        return html`
                            <div class="aa-ItemWrapper">
                                <a href="${item.url}" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                                    <div class="aa-ItemContent">
                                        <div class="aa-ItemIcon aa-ItemIcon--alignTop">
                                            <img
                                                src="${item.image}"
                                                alt="${item.name}"
                                                width="50"
                                                height="50"
                                            />
                                        </div>
                                        <div class="aa-ItemContentBody">
                                            <div class="aa-ItemContentTitle">
                                                ${components.Highlight({
                                                    hit: item,
                                                    attribute: 'name',
                                                })}
                                            </div>
                                            <div class="aa-ItemContentDescription">
                                                <span class="text-body-emphasis">
                                                    ${components.Snippet({
                                                        hit: item,
                                                        attribute: 'description',
                                                    })}
                                                </span>
                                                <div class="text-body-secondary mt-1 text-small">
                                                    ${item.byline}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="aa-ItemActions">
                                            <button
                                                class="aa-ItemActionButton aa-DesktopOnly aa-ActiveOnly"
                                                type="button"
                                                title="Select"
                                            >
                                                <svg
                                                    viewBox="0 0 24 24"
                                                    width="20"
                                                    height="20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        d="M18.984 6.984h2.016v6h-15.188l3.609 3.609-1.406 1.406-6-6 6-6 1.406 1.406-3.609 3.609h13.172v-4.031z"
                                                    />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </a>
                            </div>`;
                    },
                },
            },
        ];
    },
});
