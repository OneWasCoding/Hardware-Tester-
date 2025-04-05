@extends('layouts.template')

@yield('content')
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .main-container {
      max-width: 1200px;
      margin: 30px auto;
    }
    
    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .card-header {
      background: linear-gradient(45deg, #4361ee, #3a0ca3);
      color: white;
      border-radius: 10px 10px 0 0 !important;
    }
    
    .preview-image {
      width: 100px;
      height: 100px;
      object-fit: cover;
      margin-right: 10px;
      margin-bottom: 10px;
      border-radius: 6px;
      transition: transform 0.2s;
    }
    
    .preview-image:hover {
      transform: scale(1.05);
    }
    
    .image-preview-container {
      display: flex;
      flex-wrap: wrap;
      margin-top: 10px;
    }
    
    .image-preview-wrapper {
      position: relative;
    }
    
    .remove-image {
      position: absolute;
      top: -8px;
      right: 2px;
      background: white;
      border-radius: 50%;
      width: 22px;
      height: 22px;
      text-align: center;
      line-height: 20px;
      font-weight: bold;
      cursor: pointer;
      border: 1px solid #dee2e6;
    }
    
    .form-icon {
      color: #4361ee;
      margin-right: 8px;
    }
    
    .drop-zone {
      border: 2px dashed #ccc;
      border-radius: 8px;
      padding: 30px;
      text-align: center;
      margin-bottom: 15px;
      cursor: pointer;
      background-color: #f8f9fa;
    }
    
    .drop-zone.highlight {
      border-color: #4361ee;
      background-color: rgba(67, 97, 238, 0.1);
    }
    
    .drop-zone-icon {
      font-size: 36px;
      color: #4361ee;
      margin-bottom: 10px;
    }
  </style>
  <div class="content">
    <div class="card">
      @if($errors->any())
<div class="error">
  <ul>
    @foreach($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif
      <div class="card-header">
        <h3><i class="fas fa-box-open me-2"></i> Add New Product</h3>
      </div>
      <div class="card-body">
        <form id="productForm" action="{{route("item.store")}}" method="post" class="row g-3" enctype="multipart/form-data">
          @csrf
          <!-- Left Column - Main Info -->
          <div class="col-md-8">
            <div class="row mb-3">
              <div class="col-md-12">
                <label for="productName" class="form-label">
                  <i class="fas fa-tag form-icon"></i> Item Name*
                </label>
                <input type="text" class="form-control" id="productName" name="item_name" placeholder="Enter product name" required>
              </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="productPrice" class="form-label">
                  <i class="fas fa-dollar-sign form-icon"></i> Price*
                </label>
                <div class="input-group">
                  <span class="input-group-text">$</span>
                  <input type="number" class="form-control" name="item_price" id="productPrice" placeholder="0.00" step="0.01" min="0" required>
                </div>
              </div>
              
              <div class="col-md-6">
                <label for="productQuantity" class="form-label">
                  <i class="fas fa-cubes form-icon"></i> Quantity*
                </label>
                <div class="input-group">
                  <button class="btn btn-outline-secondary" type="button" id="decrementQty">-</button>
                  <input type="number" class="form-control" name="item_qty" id="productQuantity" placeholder="Available quantity" min="0" value="1" required>
                  <button class="btn btn-outline-secondary" type="button" id="incrementQty">+</button>
                </div>
              </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-md-12">
                <label for="productDesc" class="form-label">
                  <i class="fas fa-align-left form-icon"></i> Description
                </label>
                <textarea class="form-control" id="productDesc" name="item_desc" rows="4" placeholder="Enter product description"></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-12">
                <label for="productCategory" class="form-label">
                  <i class="fas fa-list-alt form-icon"></i> Category*
                </label>
                <select class="form-select" id="productCategory" name="item_category" required>
                  <option value="" disabled selected>Select a category</option>
                  @foreach($category as $select)
                  <option value="{{$select->category_id}}">{{$select->category_name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-12">
                <label class="form-label">
                  <i class="fas fa-circle-notch form-icon"></i> Status
                </label>
                <div class="btn-group w-100" role="group">
                  <input type="radio" class="btn-check" name="productStatus" id="statusActive" value="available " name="available" checked>
                  <label class="btn btn-outline-success" for="statusActive">
                    <i class="fas fa-check-circle me-1"></i> Available
                  </label>
                  
                  <input type="radio" class="btn-check" name="productStatus" id="statusInactive" name="out_of_stock" value="out_of_stock">
                  <label class="btn btn-outline-danger" for="statusInactive">
                    <i class="fas fa-times-circle me-1"></i> Out of Stock
                  </label>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Right Column - Photos -->
          <div class="col-md-4">
            <div class="card h-100">
              <div class="card-header bg-light">
                <i class="fas fa-images me-2"></i> Product Photos
              </div>
              <div class="card-body">
                <div class="drop-zone" id="dropZone">
                  <i class="fas fa-cloud-upload-alt drop-zone-icon"></i>
                  <p>Drag & drop your photos here<br>or click to browse</p>
                  <input type="file" name="item_img[]" id="productPhotos" multiple accept="image/*" class="d-none">
                </div>
                
                <div id="imagePreviewContainer" class="image-preview-container"></div>
              </div>
            </div>
          </div>
          
          <!-- Action Buttons -->
          <div class="col-12 mt-4">
            <div class="d-flex justify-content-end">
              <button type="button" class="btn btn-outline-secondary me-2" id="resetForm">
                <i class="fas fa-undo me-1"></i> Reset
              </button>
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Save Product
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>


  <script>
    document.addEventListener("DOMContentLoaded", function() {
        const dropZone = document.getElementById("dropZone");
        const fileInput = document.getElementById("productPhotos");
        const previewContainer = document.getElementById("imagePreviewContainer");
    
        // Click dropzone to trigger file input
        dropZone.addEventListener("click", function() {
            fileInput.click();
        });
    
        // Handle file selection changes
        fileInput.addEventListener("change", function() {
            previewImages(this.files);
        });
    
        // Preview images function
        function previewImages(files) {
            previewContainer.innerHTML = ""; // Clear previous previews
            
            if (!files || files.length === 0) return;
            
            Array.from(files).forEach(file => {
                if (!file.type.match('image.*')) return; // Skip non-images
                
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    // Create image wrapper
                    const wrapper = document.createElement('div');
                    wrapper.className = 'image-preview-wrapper';
                    
                    // Create image element
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'preview-image';
                    
                    // Create remove button
                    const removeBtn = document.createElement('span');
                    removeBtn.className = 'remove-image';
                    removeBtn.innerHTML = '&times;';
                    removeBtn.addEventListener('click', (event) => {
                        event.stopPropagation();
                        wrapper.remove();
                        removeFileFromInput(file);
                    });
                    
                    // Append elements
                    wrapper.appendChild(img);
                    wrapper.appendChild(removeBtn);
                    previewContainer.appendChild(wrapper);
                };
                
                reader.readAsDataURL(file);
            });
        }
    
        // Remove file from input
        function removeFileFromInput(fileToRemove) {
            const dt = new DataTransfer();
            const files = fileInput.files;
            
            Array.from(files).forEach(file => {
                if (file !== fileToRemove) {
                    dt.items.add(file);
                }
            });
            
            fileInput.files = dt.files;
        }
    });
    </script>