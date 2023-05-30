import { Component, OnInit } from '@angular/core';
import { ProductService } from 'src/app/services/product.service';
import { ProductModel } from 'src/app/models/product.model';
import { Location } from '@angular/common';

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.css']
})
export class ProductsComponent implements OnInit {

  products: ProductModel[] | undefined;
  newProduct: ProductModel = {
    name: '',
    category: '',
    brand: '',
    desc: '',
    price: 0,
    id: 0
  };

  constructor(
    private proSer: ProductService,
    private location: Location
  ) {}

  ngOnInit(): void {
    this.loadProducts();
  }

  loadProducts() {
    this.proSer.AllProducts.subscribe(res => {
      this.products = res;
    });
  }

  addProduct() {
    this.proSer.add(this.newProduct).subscribe(res => {
      console.log(res);
      this.newProduct = {
        name: '',
        category: '',
        brand: '',
        desc: '',
        price: 0,
        id: 0
      };
      this.refreshPage(); // Refrescar la página después de agregar un producto
    });
  }

  deleteProduct(productId: number) {
    this.proSer.delete(productId).subscribe(res => {
      console.log(res);
      this.refreshPage(); // Refrescar la página después de eliminar un producto
    });
  }

  refreshPage() {
    location.reload();
  }
}
