<table class="table">
    <thead>
        <tr>
            <th>Designation</th>
            <th>Category</th>


            <th>Prix</th>
            <th>Description</th>

        </tr>
    </thead>
    <tbody>
          @foreach ($produits as $produit )
              <tr>
                  <td scope="row"> {{ $produit->designation }}</td>
                  <td> {{ $produit->category ?  $produit->category->libelle : "Non catégorisé"}}</td>
                  <td> {{  formatPrixBf($produit->prix)  }}</td>
                  <td> {{ $produit->description }}</td>


              </tr>
          @endforeach
    </tbody>
</table>
