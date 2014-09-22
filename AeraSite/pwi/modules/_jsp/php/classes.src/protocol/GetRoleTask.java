/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GetRoleTask extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */   public GRoleTask task;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 15 */     RoleId arg = (RoleId)argument;
/* 16 */     RoleTaskRes res = (RoleTaskRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 21 */     RoleId arg = (RoleId)argument;
/* 22 */     RoleTaskRes res = (RoleTaskRes)result;
/*    */ 
/* 24 */     synchronized (this)
/*    */     {
/* 26 */       this.retcode = res.retcode;
/* 27 */       if (0 == res.retcode)
/*    */       {
/* 29 */         this.task = res.value;
/*    */       }
/*    */       else
/*    */       {
/* 33 */         this.task = null;
/*    */       }
/* 35 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 41 */     synchronized (this)
/*    */     {
/* 43 */       this.retcode = 4;
/* 44 */       this.task = null;
/* 45 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GetRoleTask
 * JD-Core Version:    0.6.2
 */