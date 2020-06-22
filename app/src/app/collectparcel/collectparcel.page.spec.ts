import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { CollectparcelPage } from './collectparcel.page';

describe('CollectparcelPage', () => {
  let component: CollectparcelPage;
  let fixture: ComponentFixture<CollectparcelPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CollectparcelPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(CollectparcelPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
