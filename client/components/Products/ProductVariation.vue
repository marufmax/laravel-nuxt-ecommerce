<template>
  <div class="field">
    <label>
      {{ type }}
    </label>

    <div class="control">
      <div class="select is-fullwidth">
        <select :value="selectedVariationId" @change="changed($event, type)">
          <option value="" disabled selected>Please choose</option>
          <option
              v-for="variation in variations"
              :key="variation.id"
              :value="variation.id"
          >
             {{ variation.name }}

            <template v-if="variation.price_varies">
              ({{ variation.price }})
            </template>
          </option>
        </select>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
        type: {
            required: true,
            type: String
        },
        variations: {
            required: true,
            type: Array
        },
        value: {
            required: false
        }
    },
      computed: {
          selectedVariationId() {
              if (!this.findVariation(this.value.id)) {
                  return '';
              }

              return this.value.id;
          }
      },
      methods: {
          changed(event) {
              this.$emit('input', this.findVariation(event.target.value));
          },
          findVariation (id) {
              let variation = this.variations.find(v => v.id == id);

              if (typeof variation === 'undefined') {
                  return null;
              }

              return variation;
          }
      }
  }
</script>
