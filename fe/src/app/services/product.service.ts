import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { productModel } from '../models/product.model';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ProductService {
  AllProducts = new BehaviorSubject<productModel[]>([]);

  constructor(private http:HttpClient) { 

  }

  private baseUrl="http://localhost:8000/api/";

  public add(form: any){
    return this.http.post(this.baseUrl+"add",form);
  }
  public delete(id: any){
    return this.http.post(this.baseUrl+"delete?id="+id,null);
  }
  public update(form: any){
    return this.http.post(this.baseUrl+"update",form);
  }
  public getFromDb(keys: any){
    return this.http.post(this.baseUrl+"get?keys="+keys,null).subscribe(res=>{
      var r:any = res;
      this.AllProducts.next(r.products)
    });
  }
}
