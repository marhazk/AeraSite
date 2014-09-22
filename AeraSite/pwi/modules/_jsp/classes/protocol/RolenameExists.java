/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class RolenameExists extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */   public int zoneid;
/*    */   public int roleid;
/*    */   public int status;
/*    */   public int time;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 18 */     RolenameExistsArg arg = (RolenameExistsArg)argument;
/* 19 */     RolenameExistsRes res = (RolenameExistsRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 24 */     RolenameExistsArg arg = (RolenameExistsArg)argument;
/* 25 */     RolenameExistsRes res = (RolenameExistsRes)result;
/*    */ 
/* 27 */     synchronized (this)
/*    */     {
/* 29 */       this.retcode = res.retcode;
/* 30 */       this.zoneid = res.zoneid;
/* 31 */       this.roleid = res.roleid;
/* 32 */       this.status = res.status;
/* 33 */       this.time = res.time;
/* 34 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 40 */     synchronized (this)
/*    */     {
/* 42 */       this.retcode = 4;
/* 43 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.RolenameExists
 * JD-Core Version:    0.6.2
 */