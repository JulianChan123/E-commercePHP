import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { DefaultRoutingModule } from './default-routing.module';
import { DefaultComponent } from './default.component';
import { DproductsComponent } from './dproducts/dproducts.component';


@NgModule({
  declarations: [
    DefaultComponent,
    DproductsComponent
  ],
  imports: [
    CommonModule,
    DefaultRoutingModule
  ]
})
export class DefaultModule { }
