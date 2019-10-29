<template>
</template>

<script>
    import {Minimum} from 'laravel-nova'
    import {mixin as clickaway} from 'vue-clickaway'

    export default {
        mixins: [clickaway],

        data: () => ({
            loading: false,
            currentlySearching: false,
            searchTerm: '',
            results: [],
            highlightedResultIndex: 0,
        }),

        watch: {
            $route: function () {
                this.closeSearch()
            },
        },

        mounted() {
            // Open search menu if the user types '/'
            document.addEventListener('keydown', this.handleKeydown)
        },

        destroyed() {
            document.removeEventListener('keydown', this.handleKeydown)
        },

        methods: {
            isNotInputElement(event) {
                const tagName = event.target.tagName
                return Boolean(tagName !== 'INPUT' && tagName !== 'TEXTAREA')
            },

            handleKeydown(event) {
                if (this.isNotInputElement(event) && event.keyCode == 191) {
                    event.preventDefault()
                    event.stopPropagation()
                    this.openSearch()
                }
            },

            openSearch() {
                this.clearSearch()
                this.$refs.input.focus()
                this.currentlySearching = true
                this.clearResults()
            },

            closeSearch() {
                this.clearSearch()
                this.clearResults()
                this.$refs.input.blur()
                this.currentlySearching = false
                this.loading = false
            },

            clearSearch() {
                this.searchTerm = ''
            },

            clearResults() {
                this.results = []
            },

            search(event) {
                this.highlightedResultIndex = 0
                this.loading = true

                if (this.searchTerm == '') {
                    this.loading = false
                    this.results = []
                } else {
                    this.debouncer(() => {
                        this.fetchResults(event.target.value)
                    }, 500)
                }
            },

            async fetchResults(search) {
                this.results = []

                if (search !== '') {
                    try {
                        const {data: results} = await Minimum(
                            Nova.request().get('/nova-api/search', {
                                params: {search},
                            })
                        )

                        this.results = results

                        this.loading = false
                    } catch (e) {
                        this.loading = false
                        throw e
                    }
                }
            },

            /**
             * Debounce function for the search handler
             */
            debouncer: _.debounce(callback => callback(), 500),

            /**
             * Move the highlighted results
             */
            move(offset) {
                if (this.results.length) {
                    let newIndex = this.highlightedResultIndex + offset

                    if (newIndex < 0) {
                        this.highlightedResultIndex = this.results.length - 1
                        this.updateScrollPosition()
                    } else if (newIndex > this.results.length - 1) {
                        this.highlightedResultIndex = 0
                        this.updateScrollPosition()
                    } else if (newIndex >= 0 && newIndex < this.results.length) {
                        this.highlightedResultIndex = newIndex
                        this.updateScrollPosition()
                    }
                }
            },

            updateScrollPosition() {
                const selection = this.$refs.selected
                const container = this.$refs.container

                this.$nextTick(() => {
                    if (selection) {
                        if (
                            selection[0].offsetTop >
                            container.scrollTop +
                            container.clientHeight -
                            selection[0].clientHeight
                        ) {
                            container.scrollTop =
                                selection[0].offsetTop +
                                selection[0].clientHeight -
                                container.clientHeight
                        }
                        if (selection[0].offsetTop < container.scrollTop) {
                            container.scrollTop = selection[0].offsetTop
                        }
                    }
                })
            },

            navigate(index) {
                this.highlightedResultIndex = index
                this.goToCurrentlySelectedResource()
            },

            goToCurrentlySelectedResource() {
                const resource = _.find(
                    this.indexedResults,
                    res => res.index == this.highlightedResultIndex
                );

                this.$router.push({
                    name: 'detail',
                    params: {
                        resourceName: resource.resourceName,
                        resourceId: resource.resourceId,
                    },
                });

                this.closeSearch()
            },
        },

        computed: {
            hasResults() {
                return this.results.length > 0
            },

            hasSearchTerm() {
                return this.searchTerm !== ''
            },

            shouldShowNoResults() {
                return (
                    this.currentlySearching &&
                    !this.loading &&
                    !this.hasResults &&
                    this.hasSearchTerm
                )
            },

            shouldShowResults() {
                return this.currentlySearching && this.hasResults && !this.loading
            },

            indexedResults() {
                return _.map(this.results, (item, index) => {
                    return {index, ...item}
                })
            },

            formattedGroups() {
                return _.chain(this.indexedResults)
                    .map(item => {
                        return {
                            resourceName: item.resourceName,
                            resourceTitle: item.resourceTitle,
                        }
                    })
                    .uniqBy('resourceName')
                    .value()
            },

            formattedResults() {
                return _.map(this.formattedGroups, group => {
                    return {
                        resourceName: group.resourceName,
                        resourceTitle: group.resourceTitle,
                        items: _.filter(
                            this.indexedResults,
                            item => item.resourceName == group.resourceName
                        ),
                    }
                })
            },
        },
    }
</script>
