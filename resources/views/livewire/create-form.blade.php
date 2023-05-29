<div>
            <form class="shadow p-5 bg-custom color-steelBlue formLavora" wire:submit.prevent="store">
            @csrf
        <div class="div-custom rounded">
        </div>

        <div class="insert-article-custom">
            
            <img class="img-form-custom" src="/media/AnnuncioDefinitivo.png" alt="">
        </div>

        
        <div class="">
            <label for="category" class="form-label">Seleziona la tua regione</label>
        <select id="category" class="form-select  @error('category') is-invalid @enderror" wire:model.defer="category"  aria-label="Default select example">
            <option value="">Scegli la regione</option>
            @foreach ($categories as $category)

                <option value="{{$category->id}}">{{$category->name}}</option>
                
            @endforeach
            
        </select>
            @error('category') <span class="error">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label for="name" class="pb-1">Città:</label>
            <input type="text" type="hidden" id="name" wire:model="query" autocomplete="off" class="form-control @error('name') is-invalid @enderror" @focus="suggestionsOpen = true" @blur="suggestionsOpen = false ">
            @if (!empty($suggestions))
                <ul class="ulCittaCustom">
                @foreach ($suggestions as $suggestion)
                <li class="cittaCustom bold" wire:click="selectCity('{{ $suggestion }}')">{{ $suggestion }}</li>
                @endforeach
                </ul>
            @endif
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        
        <div class="mb-3">
            <label for="price" class="form-label">Prezzo per notte</label>
            <input type="float" wire:model.lazy="price" class="form-control @error('price') is-invalid @enderror" id="price" wire:model.lazy="price">
            @error('price') <span class="error">{{ $message }}</span> @enderror
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea id="description" wire:model.lazy="description" cols="30" rows="7" class="form-control @error('description') is-invalid @enderror" wire:model.lazy="description"></textarea>
            @error('description') <span class="error">{{ $message }}</span> @enderror
        </div>
        
    <div class="mb-3">
        <input wire:model="temporary_images" type="file" name="images" multiple class="form-control shadow @error('temporary_images.*') is-invalid @enderror" placeholder="Img"/>
        @error('temporary_images.*')
            <p class="text-danger mt-2">{{$message}}</p>
        @enderror    
    </div>
         @if (!empty($images))
        <div class="row">
            <div class="col-12">
                <p class="text-white">Antrepima immagine:</p>
                <div class="row border border-4 border-info rounded shadow py-4">
                    @foreach ($images as $key => $image)
                    <div class="col-12 my-3">
                        <div class="img-preview mx-auto shadow rounded" style="background-image: url({{$image->temporaryUrl()}});"></div>
                        <button type="button" class="btn btn-danger shadow d-block text-center mt-2 mx-auto" wire:click="removeImage({{$key}})">Cancella</button>    
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
           
        @endif


            @if ($services)

            <div class="mb-3">
                <label for="services" class="form-label">Servizi Aggiuntivi</label><br>
                @foreach ($services as $service)
                    <div class="d-flex">
                        <input id="services" type="checkbox" wire:model="selectedServices" value="{{$service->id}}">
                                                   
                        <i class="fa {{ $service->icon }} p-2 text-start"></i>
                        
                        <span  class="">{{$service->name}}</span>
                    </div>
                @endforeach
            </div>

            @endif      
      
        <button class="btn btn-dark">Pubblica Annuncio</button>


        
        @if (session()->has('articleCreated'))
            <div class="alert snippet alert-success my-4 p-2">
                {{ session('articleCreated') }}
            </div>
        @endif

      </form>
    </div>
</div>