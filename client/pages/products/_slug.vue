<template>
  <div class="section">
    <div class="container is-fluid">
      <div class="columns">
        <div class="column is-half">
          <img src="http://via.placeholder.com/620x620" alt="Product name">
        </div>
        <div class="column is-half">
          <section class="section">
            <h1 class="title is-4">
              {{ product.name }}
            </h1>
            <p v-if="product.description">
              {{ product.description}}
            </p>

            <hr>

            <span class="tag is-rounded is-medium">
             {{ product.price }}
          </span>
          </section>

          <section class="section">
            <form action="">
              <ProductVariation
                v-for="(variation, type) in product.variations"
                v-model="form.variation"
                :type="type"
                :variations="variation"
                :key="type"
              />

              <div class="field has-addons">
                <div class="control">
                  <div class="select is-fullwidth">
                    <select name="" id="">
                      <option> 1 </option>
                    </select>
                  </div>
                </div>
                <div class="control">
                  <button type="submit"
                          class="button is-info"
                          :title="disabledTitle"
                          :disabled="!isVariationExists">Add to cart</button>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import ProductVariation from "@/components/Products/ProductVariation";

  export default {
      name: 'ProductPage',
      components: {
          ProductVariation
      },
      data() {
        return {
            product: null,
            form: {
                variation: '',
                quality: 1
            }
        }
      },
      async asyncData({params, app}) {
        let response = await app.$axios.$get(`products/${params.slug}`);

        return {
            product: response.data
        }
      },
      computed: {
          isVariationExists() {
              return Object.keys(this.form.variation).length > 0;
          },
          disabledTitle() {
              return this.isVariationExists ? null : 'Select a variation, Please?';
          }
      }
  }
</script>
