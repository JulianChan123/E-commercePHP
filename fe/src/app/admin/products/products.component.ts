import { Component, OnInit } from '@angular/core';
import { ProductService } from 'src/app/services/product.service';
import { productModel } from 'src/app/models/product.model';

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.css']
})
export class ProductsComponent implements OnInit{

  products:productModel[] | undefined;
  constructor(private proSer:ProductService) { }
  
  ngOnInit(): void {
    this.proSer.AllProducts.subscribe(res=>{
      this.products=res;
      console.log(this.products);
    });
  }
}
