import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { CollectparcelPageRoutingModule } from './collectparcel-routing.module';

import { CollectparcelPage } from './collectparcel.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    CollectparcelPageRoutingModule
  ],
  declarations: [CollectparcelPage]
})
export class CollectparcelPageModule {}
