<template>
  <div class="sidebar-wrapper">
    <div class="sidebar-section">
      <h3><span v-on:click="toggle('archive')" class="fa fa-circle"></span> Archive</h3>
      <ul v-bind:class="'side-nav-item list-unstyled' + (view_item === 'archive' ? ' display' : '')">
        <li v-for="months, year of archive">{{ year }}
          <ul v-for="posts, month of months" class="list-unstyled">
            <li class="archive-month">{{ month }}
              <ul class="list-unstyled">
                <li class="archive-post" v-for="post of posts"><a v-bind:href="url('/posts/', post.id)">{{ post.title }}</a></li>
              </ul>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="sidebar-section">
      <h3><span v-on:click="toggle('categories')" class="fa fa-circle"></span> Categories</h3>
      <ul v-bind:class="'side-nav-item list-unstyled' + (view_item === 'categories' ? ' display' : '')">
        <li v-for="category of categories"><a v-bind:href="url('/categories/', category.id)">{{ category.title }}</a></li>
      </ul>
    </div>
    <div class="sidebar-section">
      <h3><span v-on:click="toggle('most_used_tags')" class="fa fa-circle"></span> Tags</h3>
      <ul v-bind:class="'side-nav-item list-unstyled' + (view_item === 'most_used_tags' ? ' display' : '')">
        <li v-for="tag of most_used_tags"><a v-bind:href="url('/tags/', tag.id)">{{ tag.title }}</a></li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      archive: window.collected_archive,
      view_item: '',
      categories: [],
      most_used_tags: []
    }
  },
  mounted() {
    this.get('api.tags.most_used');
    this.get('api.categories.index');
  },
  methods: {
    url: function(url, id) {
      return url + id;
    },
    toggle: function(item) {
      if (this.view_item === item) {
        this.view_item = null;
      } else {
        this.view_item = item;
      }
    },
    get: function(route) {
      this.$routeLaravel(route).url()
      .then(response => {
        axios.get(response).then(r => {
          if (route === 'api.tags.most_used') {
            this.most_used_tags = r.data;
          } else if (route === 'api.categories.index') {
            this.categories = r.data;
          }
        }).catch(error => {
          console.log(error);
        });
      });
    },
  }
}
</script>