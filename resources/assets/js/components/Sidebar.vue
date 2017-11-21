<template>
  <div class="sidebar-wrapper">
    <div class="sidebar-section">
      <h3><span v-on:click="toggle('archive')" class="fa fa-circle"></span> Archive</h3>
      <ul v-bind:class="'side-nav-item list-unstyled' + (view_item === 'archive' ? ' display' : '')">
        <li v-for="months, year of archive">{{ year }}
          <ul v-for="posts, month of months" class="list-unstyled">
            <li class="archive-month">{{ month }}
              <ul class="list-unstyled">
                <li class="archive-post" v-for="post of posts"><a v-bind:href="url(post.id)">{{ post.title }}</a></li>
              </ul>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="sidebar-section">
      <!-- This section is only for testing -->
      <h3><span v-on:click="toggle('archive2')" class="fa fa-circle"></span> Archive 2</h3>
      <ul v-bind:class="'side-nav-item list-unstyled' + (view_item === 'archive2' ? ' display' : '')">
        <li v-for="months, year of archive">{{ year }}
          <ul v-for="posts, month of months" class="list-unstyled">
            <li class="archive-month">{{ month }}
              <ul class="list-unstyled">
                <li class="archive-post" v-for="post of posts"><a v-bind:href="url(post.id)">{{ post.title }}</a></li>
              </ul>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      archive: window.collected_archive,
      view_item: ''
    }
  },
  mounted() {
    //
  },
  methods: {
    url: function(id) {
      return '/posts/' + id;
    },
    toggle: function(item) {
      if (this.view_item === item) {
        this.view_item = null;
      } else {
        this.view_item = item;
      }
    }
  }
}
</script>