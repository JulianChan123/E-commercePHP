import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';
import { User } from 'src/app/models/user/user';

@Injectable({
  providedIn: 'root'
})
export class RegistroService {

  allUser = new BehaviorSubject<User[]>([]);

  constructor(private http:HttpClient) { 
    this.getFromDb("");
  }
  public getFromDb(keys: any){
    return this.http.post(this.baseUrl+"get?keys="+keys,null).subscribe(res=>{
      var r:any = res;
      this.allUser.next(r.user)
    });
  }

  private baseUrl="http://localhost:8000/api/";

  public registrarUser(user: User){
    return this.http.post(this.baseUrl+"register",user);
  }

}
