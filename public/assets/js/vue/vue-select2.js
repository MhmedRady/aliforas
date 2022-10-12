Vue.component('select2', {
    props: {
        allowClear: {
            type: Boolean,
            default: false
        },
        placeholder: {
            type: String,
            default: ''
        },
        minimumInputLength: {
            type: Number,
            default: 3
        },
        minimumResultsForSearch: {
            type: Number,
            default: 5
        },
        options: Array,
        ajaxUrl: String,
        templateResult: Function,
        templateSelection: Function,
        value: {
            type: [String, Number],
            default: null
        },
        customCss: {
            type: Object,
            default: function(){
                return {};
            }
        },
    },
    template: '<select><slot></slot></select>',
    mounted: function() {
        let vm = this;

        $(this.$el)
        // init select2
        .select2(this.select2Options())
        .val(this.value)
        .trigger('change')
        // emit event on change.
        .on('change', function() {
            vm.$emit('input', this.value);
            vm.$emit('change', this);
        });

        for (let [key, value] of Object.entries(this.customCss)) {
            $($(vm.$el).data('select2').$dropdown).css(key, value);
        }
    },
    methods: {
        select2Options: function(){
            let data = {
                allowClear : this.allowClear ,
                placeholder : this.placeholder ,
                minimumInputLength : this.minimumInputLength ,
                minimumResultsForSearch : this.minimumResultsForSearch ,
                templateResult: this.templateResult,
                templateSelection: this.templateSelection,
                escapeMarkup: function (markup) {
                    return markup;
                },
            };
            if(this.ajaxUrl !== undefined)
                data.ajax = {
                    url: this.ajaxUrl,
                    dataType: 'json',
                    delay: 250,
                    cache: true,
                    data: function (params) {
                        return {
                            q: params.term,
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * 15) < data.total
                            }
                        };
                    },
                };
            else if(this.options !== undefined && this.options.length > 0)
                data.data = this.options;
            return data;
        }
    },
    watch: {
        value: {
            handler: function(value) {
                // update value
                if(this.$el.value !== value)
                    $(this.$el).val(value).trigger('change');
            },
            deep: true
        },
        options: function(options) {
            $(this.$el).html('').select2(this.select2Options());
        },
        allowClear: function(value) {
            $(this.$el).select2(this.select2Options());
        },
        placeholder: function(value) {
            $(this.$el).select2(this.select2Options());
        },
        minimumInputLength: function(value) {
            $(this.$el).select2(this.select2Options());
        },
        minimumResultsForSearch: function(value) {
            $(this.$el).select2(this.select2Options());
        }
    },
    beforeDestroy: function() {
        $(this.$el).off().select2('destroy');
    }
});
