import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { DefaultComponent } from './default.component';
import { DproductsComponent } from './dproducts/dproducts.component';

const routes: Routes = [
  {path:'', component:DefaultComponent,
  children:[
    {path: 'products', component:DproductsComponent}
  ]}
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class DefaultRoutingModule { }
