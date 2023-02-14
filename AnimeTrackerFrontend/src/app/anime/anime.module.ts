import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ProducerComponent } from './pages/producer/producer.component';
import { CharacterComponent } from './pages/character/character.component';
import { ResultsComponent } from './pages/results/results.component';
import { PopularListComponent } from './pages/popular-list/popular-list.component';
import { InfoComponent } from './pages/info/info.component';
import { AppRoutingModule } from '../app-routing.module';


@NgModule({
  declarations: [
    ProducerComponent,
    CharacterComponent,
    ResultsComponent,
    PopularListComponent,
    InfoComponent
  ],
  exports: [
    ProducerComponent,
    CharacterComponent,
    ResultsComponent,
    PopularListComponent,
    InfoComponent
  ],
  imports: [
    CommonModule,
    AppRoutingModule
  ]
})
export class AnimeModule { }
