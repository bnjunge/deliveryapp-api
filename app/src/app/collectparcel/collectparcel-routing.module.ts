import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { CollectparcelPage } from './collectparcel.page';

const routes: Routes = [
  {
    path: '',
    component: CollectparcelPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class CollectparcelPageRoutingModule {}
