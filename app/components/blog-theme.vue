<template>
    <div>
        <div class="uk-margin">
            <label class="uk-form-label">{{ "Youtube URL" | trans }}</label>
            <div class="uk-form-controls">
                <input type="url" v-model="post.data.theme.youtube_url" class="uk-input" />
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-lable">
                {{ "Sources" | trans }}
                <a @click.prevent="addSource">{{ "Add Source" | trans }} </a>
            </label>
            <div class="uk-form-label" v-for="(source, id) in this.post.data.theme.sources" :key="id">
                <div class="uk-margin uk-flex uk-flex-between">
                    <input type="text" :placeholder="'Source Title' | trans" v-model="source.title" class="uk-input" required />
                    <input type="url" :placeholder="'Source URL' | trans" v-model="source.url" class="uk-input" required />
                    <button class="uk-button uk-button-danger" @click.prevent="deleteSource(id)">{{ "Delete" | trans }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
const BlogTheme = {
    props: ["post", "data"],

    section: {
        label: "Blog Theme",
        priority: 7,
    },

    created() {
        if (!this.post.data["theme"]) {
            this.post.data = _.extend(
                {
                    theme: {
                        youtube_url: "",
                        sources: [],
                    },
                },
                this.post.data
            );
        }
    },

    methods: {
        addSource() {
            this.post.data.theme.sources.push({
                title: "",
                url: "",
            });
        },

        deleteSource(id) {
            this.post.data.theme.sources.splice(id, 1);
        },
    },
};

export default BlogTheme;

window.Post.components["blog-theme"] = BlogTheme;
</script>
