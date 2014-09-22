/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.TimerTask;
/*    */ import com.goldhuman.IO.PollIO;
/*    */ import com.goldhuman.IO.Protocol.Manager;
/*    */ import com.goldhuman.IO.Protocol.Protocol;
/*    */ import com.goldhuman.IO.Protocol.ReconnectTask;
/*    */ import com.goldhuman.IO.Protocol.Session;
/*    */ import com.goldhuman.IO.Protocol.State;
/*    */ import java.io.PrintStream;
/*    */ 
/*    */ public final class DeliveryClientManager extends Manager
/*    */ {
/* 16 */   private static DeliveryClientManager manager = new DeliveryClientManager();
/*    */   public Session s;
/* 35 */   private boolean conn_state = false;
/*    */ 
/* 23 */   private Object locker_state = new Object();
/*    */   private static final int BACKOFF_INIT = 2;
/*    */   private static final int BACKOFF_DEADLINE = 8;
/* 35 */   private int backoff = 2;
/*    */ 
/*    */   public static DeliveryClientManager GetInstance()
/*    */   {
/* 18 */     return manager;
/*    */   }
/*    */ 
/*    */   void Reconnect()
/*    */   {
/* 29 */     System.out.println("DeliveryClientManager reconnect");
/* 30 */     TimerTask.AddTimerTask(new ReconnectTask(this, 1), this.backoff);
/* 31 */     this.backoff *= 2;
/* 32 */     if (this.backoff > 8) this.backoff = 8; 
/*    */   }
/*    */ 
/*    */   public boolean GetConnectState()
/*    */   {
/* 36 */     return this.conn_state;
/*    */   }
/*    */ 
/*    */   protected synchronized void OnAddSession(Session session) {
/* 40 */     synchronized (this.locker_state)
/*    */     {
/* 42 */       if (this.conn_state)
/*    */       {
/* 44 */         Close(session);
/* 45 */         return;
/*    */       }
/* 47 */       this.conn_state = true;
/* 48 */       this.s = session;
/* 49 */       this.backoff = 2;
/*    */     }
/* 51 */     System.out.println("DeliveryClientManager::OnAddSession " + session);
/* 52 */     AnnounceLinkType ku = (AnnounceLinkType)Protocol.Create("AnnounceLinkType");
/* 53 */     Send(this.s, ku);
/* 54 */     PollIO.WakeUp();
/*    */   }
/*    */ 
/*    */   protected synchronized void OnDelSession(Session session)
/*    */   {
/* 67 */     synchronized (this.locker_state) {
/* 68 */       this.conn_state = false;
/* 69 */       Reconnect();
/*    */     }
/* 71 */     System.out.println("DeliveryClientManager::OnDelSession " + session);
/*    */   }
/*    */ 
/*    */   protected synchronized void OnAbortSession(Session session)
/*    */   {
/* 79 */     synchronized (this.locker_state) {
/* 80 */       this.conn_state = false;
/* 81 */       Reconnect();
/*    */     }
/* 83 */     System.out.println("DeliveryClientManager::OnAbortSession " + session);
/*    */   }
/*    */ 
/*    */   protected State GetInitState()
/*    */   {
/* 90 */     return State.Get("normal");
/*    */   }
/*    */ 
/*    */   protected String Identification()
/*    */   {
/* 95 */     return "DeliveryClient";
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.DeliveryClientManager
 * JD-Core Version:    0.6.2
 */