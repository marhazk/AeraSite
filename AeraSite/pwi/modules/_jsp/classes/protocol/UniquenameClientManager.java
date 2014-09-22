/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.TimerTask;
/*    */ import com.goldhuman.IO.Protocol.Manager;
/*    */ import com.goldhuman.IO.Protocol.ReconnectTask;
/*    */ import com.goldhuman.IO.Protocol.Session;
/*    */ import com.goldhuman.IO.Protocol.State;
/*    */ import java.io.PrintStream;
/*    */ 
/*    */ public final class UniquenameClientManager extends Manager
/*    */ {
/*    */   public Session s;
/* 27 */   private boolean conn_state = false;
/*    */ 
/* 16 */   private Object locker_state = new Object();
/*    */   private static final int BACKOFF_INIT = 2;
/*    */   private static final int BACKOFF_DEADLINE = 8;
/* 27 */   private int backoff = 2;
/*    */ 
/*    */   void Reconnect()
/*    */   {
/* 22 */     TimerTask.AddTimerTask(new ReconnectTask(this, 1), this.backoff);
/* 23 */     this.backoff *= 2;
/* 24 */     if (this.backoff > 8) this.backoff = 8; 
/*    */   }
/*    */ 
/*    */   public boolean GetConnectState()
/*    */   {
/* 28 */     return this.conn_state;
/*    */   }
/*    */ 
/*    */   protected synchronized void OnAddSession(Session session) {
/* 32 */     synchronized (this.locker_state) {
/* 33 */       if (this.conn_state)
/*    */       {
/* 35 */         Close(session);
/* 36 */         return;
/*    */       }
/* 38 */       this.conn_state = true;
/* 39 */       this.s = session;
/* 40 */       this.backoff = 2;
/*    */     }
/* 42 */     System.out.println("UniquenameClientManager::OnAddSession " + session);
/* 43 */     notify();
/*    */   }
/*    */ 
/*    */   protected void OnDelSession(Session session)
/*    */   {
/* 48 */     synchronized (this.locker_state) {
/* 49 */       this.conn_state = false;
/* 50 */       Reconnect();
/*    */     }
/* 52 */     System.out.println("UniquenameClientManager::OnDelSession " + session);
/* 53 */     this.s = null;
/*    */   }
/*    */ 
/*    */   protected void OnAbortSession(Session session)
/*    */   {
/* 59 */     synchronized (this.locker_state) {
/* 60 */       this.conn_state = false;
/* 61 */       Reconnect();
/*    */     }
/* 63 */     System.out.println("UniquenameClientManager::OnAbortSession " + session);
/* 64 */     this.s = null;
/*    */   }
/*    */ 
/*    */   protected State GetInitState()
/*    */   {
/* 69 */     return State.Get("normal");
/*    */   }
/*    */ 
/*    */   protected String Identification()
/*    */   {
/* 74 */     return "UniqueNameClient";
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.UniquenameClientManager
 * JD-Core Version:    0.6.2
 */