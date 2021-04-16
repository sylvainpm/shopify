<x-master-layout>
        <div class="container">

<div class="row" >
     <div class="col-md-12 mt-4" >
        <h1 class="text-center">Tous nos produits</h1>
        <hr/>
     </div>
  </div>

  <div class="row" >
    <div class="col-md-12" >

        @if(session('statut'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            {{-- {{ session('statut') }} --}}
              {{ session('statut') }}
          </div>
        @endif

        <div class="">
            <a class="btn btn-success btn-sm" href="{{ route('produits.create') }}"> <i class="fas fa-plus"></i>Ajouter</a>
            <a class="btn btn-primary btn-sm mr-4"  href="{{ route('export') }}"> <i class="fas fa-download"></i>Exporter</a>
        </div>


        <script>
          $(".alert").alert();
        </script>
        {{-- Le nom de l'image sélectionné est :{{ session("imageName") }} --}}
      <table class="table">
          <thead>
              <tr>
                  <th>Designation</th>
                  <th>Category</th>


                  <th>Prix</th>
                  <th>Description</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
                @foreach ($produits as $produit )
                    <tr>
                        <td scope="row"> {{ $produit->designation }}</td>
                        <td> {{ $produit->category ?  $produit->category->libelle : "Non catégorisé"}}</td>
                        <td> {{  formatPrixBf($produit->prix)  }}</td>
                        <td> {{ $produit->description }}</td>

                        <td>
                            <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-primary btn-sm  mr-2"><i class="fas fa-edit    "></i></a>
            {{-- <a  href=" {{ route('produits.destroy' , $produit->id ) }}" class="btn btn-danger btn-sm"  onClick="event.preventDefault();if(confirm('Etes vous sûr de vouloir supprimer cet produit ?')) document.getElementById({{ $produit->id }}).submit()"><i class="fas fa-trash    "></i></a> --}}
            <a  href="#" class="btn btn-danger btn-sm"  onClick="event.preventDefault(); suppressionConfirm('{{ $produit->id }}')"><i class="fas fa-trash    "></i></a>
                            <form id="{{ $produit->id }}" method="post" action="{{ route('produits.destroy' , $produit->id ) }}">
                                @csrf
                                @method("DELETE")
                            </form>
                        </td>
                    </tr>
                @endforeach
          </tbody>
      </table>

            <div class="mt-5  d-flex justify-content-center">
            {{ $produits->links() }}
            </div>
    </div>
 </div>


</div>
</x-master-layout>
